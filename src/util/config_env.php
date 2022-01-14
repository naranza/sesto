<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/is_file_readable.php';
require_once SESTO_DIR . '/util/config.php';

function sesto_config_env(string $filename, string $env, string $ext = '.php'): array
{
  $path = $filename . '_' . $env. $ext;
  if (!sesto_is_file_readable($path)) {
    $path = $filename . $ext;
  }
  return sesto_config($path);
}
