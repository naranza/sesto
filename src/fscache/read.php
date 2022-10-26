<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_fscache_read(string $path): ?string
{
  $result = file_get_contents($path);
  if (false === $result) {
    $result = null;
  }
  return $result;
}

