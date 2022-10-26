<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_rule_greater_than($value, $min, bool $equal = false): bool
{
  if ($equal) {
    return $value >= $min;
  } else {
    return $value > $min;
  }
}
