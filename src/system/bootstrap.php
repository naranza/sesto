<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

require_once 'init_sys.php';
require_once 'init_app.php';

function sesto_system_bootstrap(string $root_dir, string $env, string $app_name, array $sys_dirs = [], array $app_dirs = []): string
{
  $error = sesto_system_init_sys($root_dir, $env, $sys_dirs);
  if ('' === $error) {
    $app_dir = SYS_APP_DIR;
    if ('' !== $app_name) {
      $app_dir .= '/' . $app_name;
    }
    $error = sesto_system_init_app($app_dir, $app_name, $app_dirs);
    if (defined('SESTO_DIR')) {
      require SESTO_DIR . '/app/call.php';
    } else {
      $error = 'Sesto library not initialized';
    }
  }
  return $error;
}