<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.com
 * ========================================================================== */

declare(strict_types=1);

require_once 'sys.php';
require_once 'app.php';

function sesto_setup_all(
  string $sys_dir,
  string $sys_name,
  string $app_name,
  array $sys_dirs = [],
  array $app_dirs = []): string
{
  $error = sesto_setup_sys($sys_dir, $sys_name, $sys_dirs);
  if ('' === $error) {
    $error = sesto_setup_app(SYS_APP_DIR, $app_name, $app_dirs);
  }
  return $error;
}
