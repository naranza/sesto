<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_tld_exists(string $tld): bool
{
  $tld = str_replace(chr(0), '', $tld); /* filter null byte */
  if ('' === $tld) {
    $result = false;
  } else {
    $result = file_exists(__DIR__ . '/data/' . $tld);
  }
  return $result;
}

