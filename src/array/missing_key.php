<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_array_missing_key(array $expected, array $input): array
{
  $missing = [];
  foreach ($expected as $name) {
    if (!array_key_exists($name, $input)) {
      $missing[] = $name;
    }
  }
  return $missing;
}

