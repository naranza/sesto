<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once 'sys.php';
require_once 'app.php';

function sesto_setup_sysapp(string $sys_dir, string $sys_env, string $app_name, array $sys_initmes = [], array $app_initmes = []): string
{
  $error = sesto_setup_sys($sys_dir, $sys_env, $sys_initmes);
  if ('' === $error) {
    $error = sesto_setup_app(SYS_APP_DIR, $app_name, $app_initmes);
  }
  return $error;
}
