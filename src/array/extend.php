<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_array_extend(array $a, array $b): array
{
  foreach ($b as $key => $value) {
    if (is_array($value)) {
      if (!isset($a[$key])) {
        $a[$key] = $value;
      } else {
        $a[$key] = sesto_array_extend($a[$key], $value);
      }
    } else {
      $a[$key] = $value;
    }
  }
  return $a;
}
