<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_get_commands(array $arguments): array
{
  $options = getopt('c::b::s::e::');
  $count_options = count($options);
  $error = '';
  $cli_commands = array(
    'test_path' => '',
    'config_path' => $options['c'] ?? 'bateo_config.php',
    'bootstrap_path' => $options['b'] ?? '',
    'handle_shutdown' => (bool) ($options['s'] ?? true),
    'error_reporting' => (int) ($options['s'] ?? 0)
  );
  $count_argv = count($arguments);
  if ($count_argv < 2 || ($count_options + 1 == $count_argv)) {
    $error = 'Error test_path not set';
  } else {
    $cli_commands['test_path'] = end($arguments);
  }

  return [$cli_commands, $error];
}
