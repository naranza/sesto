<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_normalize_array(array $source, array $data): array
{
  $normalized = $source;
  foreach ($source as $key => $value) {
    if (isset($data[$key])) {
      $normalized[$key] = $data[$key];
    }
  }
  return $normalized;
}
