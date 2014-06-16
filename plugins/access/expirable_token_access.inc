<?php

/**
 * Plugins are described by creating a $plugin array which will be used
 * by the system that includes this file.
 */
$plugin = array(
  'title' => t('Token access (Expirable)'),
  'description' => t('Control access by an expirable token presence.'),
  'class' => 'CToolsExpirableTokenAccess',
  'callback' => 'ctools_token_access_access_callback',
  'settings form' => 'ctools_token_access_settings_form',
  'summary' => 'ctools_token_access_summary',
  'default' => array(
    'variable_name' => '',
    'parameter_name' => 'secret',
    'expires_in' => '+1 week',
  ),
);