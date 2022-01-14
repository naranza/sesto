<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/type/get.php';

function sesto_type_check($expression, string $expected): string
{
  $error = '';
  $got = sesto_type_get($expression);
  if ($expected !== $got) {
    $error = sprintf("Invalid type: '%s' expected '%s' got", $expected, $got);
  }
  return $error;
}

