<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/load_config.php';

function sesto_require_config(string $path, bool $strict = true): array
{
  $config = sesto_load_config($path, $strict);
  $path = $config['php_include'] ?? '';
  if ('' !== $path) {
    include $path;
  }
  $path = $config['php_include_once'] ?? '';
  if ('' !== $path) {
    include_once $path;
  }
  $path = $config['php_require'] ?? '';
  if ('' !== $path) {
    require $path;
  }
  $path = $config['php_require_once'] ?? '';
  if ('' !== $path) {
    require_once $path;
  }
  return $config;
}

