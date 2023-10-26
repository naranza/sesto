<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_cast_to_string($value): string
{
  if (is_object($value) && !method_exists($value, '__toString')) {
    $filtered = 'Object';
  } else {
    $filtered = (string) $value;
  }
  return $filtered;
}
