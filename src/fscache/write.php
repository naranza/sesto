<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_fscache_write(string $path, string $value): bool
{
  return is_int(file_put_contents($path, $value));
}
