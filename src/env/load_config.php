<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/load_config.php';
require_once SESTO_DIR . '/env/path.php';

function sesto_env_load_config(string $path, string $env): array
{
  $pro_path = sesto_env_path($path, '');
  $env_path = sesto_env_path($path, $env);
  $config = [];
  if (is_file($env_path) && is_readable($env_path)) {
    $config = sesto_load_config($env_path);
  } else if (is_file($pro_path) && is_readable($pro_path) ) {
    $config = sesto_load_config($pro_path);
  }
  return $config;
}

