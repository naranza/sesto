<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/load_config.php';

function sesto_form_filter(array $filters, $value)
{
  $filtered = $value;
  foreach ($filters as $path) {
    $filter = sesto_load_config($path);
    $path = $filter['php_require_once'] ?? '';
    if ('' !== $path) {
      require_once $path;
    }
    $call_function = $filter['function'];
    $filtered = $call_function($filtered);
  }
  return $filtered;
}

