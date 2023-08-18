<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_fscache_expired(string $path, int $ttl): bool
{
  $created = file_exists($path) ? filemtime($path) : 0;
  return time() > $ttl + $created;
}
