<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_array_range($start, $end, $step = 1, string $format_key = null, string $format_value = null)
{
  $data = [];
  foreach (range($start, $end, $step) as $value) {
    if (null === $format_key) {
      $key = $value;
    } else {
      $key = sprintf((string) $format_key, $value);
    }
    if (null !== $format_value) {
      $value = sprintf((string) $format_value, $value);
    }
    $data[$key] = $value;
  }
  return $data;
}

