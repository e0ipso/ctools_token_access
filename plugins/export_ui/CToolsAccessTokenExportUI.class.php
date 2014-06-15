<?php

/**
 * @file
 * Export UI overwrites file.
 */

class CToolsAccessTokenExportUI extends ctools_export_ui {

  /**
   * Gets the UI form
   */
  public static function form(&$form, &$form_state) {
    $token = $form_state['item'];
    $form['value'] = array(
      '#type' => 'textfield',
      '#title' => t('Variable value'),
      '#description' => t('This is the secret token that you will need to distribute.'),
      '#default_value' => $token->value,
      '#suffix' => '<p><strong>' . t('Recommended: ') . '</strong>' . t('Leave the variable value empty to generate a random value.') . '</p>',
    );
  }

  /**
   * UI form submission.
   */
  public static function submit(&$form, &$form_state) {
    $values = &$form_state['values'];
    if (empty($values['value'])) {
      $values['value'] = static::generateToken();
    }
  }

  /**
   * UI form validation.
   */
  public static function validate(&$form, &$form_state) {}

  /**
   * Generate a random access token.
   *
   * @return string
   *   A random access token.
   */
  public static function generateToken() {
    return drupal_random_key();
  }

  /**
   * Overrides ctools_export_ui::list_table_header().
   */
  public function list_table_header() {
    $header = parent::list_table_header();
    $column = array(array('data' => t('Token value'), 'class' => array('ctools-export-ui-token-value')));
    // Insert the new column in the header array.
    array_splice($header, 1, 0, $column);

    return $header;
  }

  /**
   * Overrides ctools_export_ui::list_build_row().
   */
  public function list_build_row($item, &$form_state, $operations) {
    parent::list_build_row($item, $form_state, $operations);
    $name = $item->{$this->plugin['export']['key']};
    $column = array(array('data' => check_plain($item->value), 'class' => array('ctools-export-ui-token-value')));

    // Insert the new column in the rows array.
    array_splice($this->rows[$name]['data'], 1, 0, $column);
  }

}
