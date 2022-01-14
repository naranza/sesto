<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_rule_less_than($value, $min, bool $equal = false): bool
{
  if ($equal) {
    return $value <= $min;
  } else {
    return $value < $min;
  }
}

