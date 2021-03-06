<?php

/**
 * Plugins are described by creating a $plugin array which will be used
 * by the system that includes this file.
 */
$plugin = array(
  'title' => t('Token access'),
  'access type' => 'cta',
  'description' => t('Control access by token presence.'),
  'class' => 'CToolsTokenAccess',
  'default' => array(
    'variable_name' => '',
    'parameter_name' => 'secret',
  ),
);
