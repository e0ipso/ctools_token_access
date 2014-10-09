<?php

/**
 * Contains CToolsAccessBase.
 */

abstract class CToolsAccessBase implements CToolsAccessInterface {

  /**
   * Holds the CTools context.
   *
   * @var array
   */
  protected $context;

  /**
   * Default constructor.
   *
   * @param array $conf
   *   Plugin configuration.
   * @param array $context
   *   Context object.
   */
  public function __construct($conf, $context) {
    $this->setContext($context);
  }

  /**
   * @param array $context
   */
  public function setContext($context) {
    $this->context = $context;
  }

  /**
   * @return array
   */
  public function getContext() {
    return $this->context;
  }

}
