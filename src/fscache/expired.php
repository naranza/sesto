<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_fscache_expired(string $path, int $ttl): bool
{
  $created = file_exists($path) ? @filemtime($path) : 0;
  return time() > $ttl + $created;
}

