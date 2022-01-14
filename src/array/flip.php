<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_array_flip(array $map, array $input, bool $key_to_value): array
{
  $result = [];
  foreach ($map as $original => $mapped) {
    if ($key_to_value) {
      if (array_key_exists($mapped, $input)) {
        $result[$original] = $input[$mapped];
      }
    } else {
      if (array_key_exists($original, $input)) {
        $result[$mapped] = $input[$original];
      }
    }
  }
  return $result;
}

