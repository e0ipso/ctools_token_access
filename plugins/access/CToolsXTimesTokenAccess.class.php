<?php

/**
 * Contains CToolsTokenAccess.
 */

class CToolsXTimesTokenAccess extends CToolsTokenAccess {

  /**
   * Maximum number of hits.
   *
   * @var int
   */
  protected $maxHits;

  /**
   * {@inheritdoc}
   */
  public function __construct($conf, $context) {
    parent::__construct($conf, $context);
    $this->maxHits = empty($conf['max_hits']) ? 1 : $conf['max_hits'];
  }

  /**
   * {@inheritdoc}
   */
  public function access() {
    if (!parent::access()) {
      return FALSE;
    }
    $hits = $this->hit();
    return $hits <= $this->maxHits;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm() {
    $form = parent::settingsForm();
    $form['settings']['max_hits'] = array(
      '#type' => 'textfield',
      '#title' => t('Max hits'),
      '#description' => t('Maximum number of times that the token can be used.'),
      '#element_validate' => array(
        'element_validate_integer_positive',
      ),
      '#default_value' => $this->maxHits,
      '#required' => TRUE,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    $summary .= ' ' . t('Expires after @max uses. Used @hits times.', array(
      '@max' => $this->maxHits,
      '@hits' => $this->getHits(),
    ));
    return $summary;
  }

  /**
   * Get the number of hits for an access token.
   *
   * @return int
   *   The number of times the token has been used.
   */
  protected function getHits() {
    $record = $this->load();
    if (!empty($record->data['hits'])) {
      return $record->data['hits'];
    }
    return 0;
  }


  /**
   * Increment the hits counter for the current token and return the number of
   * hits.
   *
   * @return int
   *   The number of times the token has been hit.
   */
  protected function hit() {
    // Make sure we only process one hit per request.
    $hit_processed = &drupal_static(__CLASS__ . __FUNCTION__);
    if (isset($hit_processed)) {
      return $this->getHits();
    }
    $hits = $this->getHits() + 1;
    $record = $this->load();

    // Add a new hit.
    $record->data['hits'] = $hits;
    $this->save($record);
    $hit_processed = TRUE;

    return $hits;
  }

}
