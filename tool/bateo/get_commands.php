<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

function bateo_get_commands(array $arguments): array
{
  $options = getopt('c::b::s::e::');
  $count_options = count($options);
  $cli_commands = array(
    'config_path' => $options['c'] ?? 'bateo_config.php',
    'bootstrap_path' => $options['b'] ?? '',
    'handle_shutdown' => (bool) ($options['s'] ?? true),
    'error_reporting' => (int) ($options['s'] ?? 0)
  );
  $count_argv = count($arguments);
  if ($count_argv < 2) {
    throw new exception('Error destination not set');
  } else if($count_argv == 2 && ($count_options + 1 == $count_argv)) {
    throw new exception('Error destination not set');
  } else {
    $cli_commands['destination'] = end($arguments);
  }

  return $cli_commands;
}
