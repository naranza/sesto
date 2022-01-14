<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_cast_to_string($value): int
{
  if (is_object($input) && !method_exists($input, '__toString')) {
    $filtered = 'Object';
  } else {
    $filtered = (string) $input;
  }
  $return = $filtered;
}

