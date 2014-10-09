<?php

/**
 * Plugins are described by creating a $plugin array which will be used
 * by the system that includes this file.
 */
$plugin = array(
  'title' => t('Token access (Expirable)'),
  'access type' => 'cta',
  'description' => t('Control access by an expirable token presence.'),
  'class' => 'CToolsExpirableTokenAccess',
  'default' => array(
    'variable_name' => '',
    'parameter_name' => 'secret',
    'expires_in' => array(
      'interval' => '1',
      'period' => 'week',
    ),
  ),
);
