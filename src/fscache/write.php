<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_fscache_write(string $path, string $value): bool
{
  $result = false;
  $fp = fopen($path, 'w');
  if ($fp !== false) {
    $result = fwrite($fp, $value);
    if (false !== $result) {
      $result = fclose($fp);
    }
  }
  return $result;
}

