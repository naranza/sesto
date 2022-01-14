<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_fscache_write(string $path, string $value): bool
{
  $result = false;
  $fp = @fopen($path, 'w');
  if ($fp !== false) {
    $result = fwrite($fp, $value);
    if (false !== $result) {
      $result = fclose($fp);
    }
  }
  return $result;
}

