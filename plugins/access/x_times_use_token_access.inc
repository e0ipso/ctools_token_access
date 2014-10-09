<?php

/**
 * Plugins are described by creating a $plugin array which will be used
 * by the system that includes this file.
 */
$plugin = array(
  'title' => t('Token Access (Multiple hits)'),
  'access type' => 'cta',
  'description' => t('Control access by token presence, limit by hits. One token can only be hit a number of times.'),
  'class' => 'CToolsXTimesTokenAccess',
  'default' => array(
    'variable_name' => '',
    'parameter_name' => 'secret',
    'max_hits' => 1,
  ),
);
