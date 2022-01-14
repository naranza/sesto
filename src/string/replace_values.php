<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_string_replace_values(string $input, array $values, string $lhs = '%', string $rhs = '%'): string
{
  $replace = [];
  foreach ($values as $key => $val) {
    if (is_array($val) || (is_object($val) && method_exists($val, '__toString'))) {
      $replace[$lhs . $key . $rhs] = (string) $val;
    } else {
      $replace[$lhs . $key . $rhs] = $val;
    }
  }
  return strtr($input, $replace);
}

