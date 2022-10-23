<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

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
