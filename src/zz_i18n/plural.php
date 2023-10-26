<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_i18n_plural(string $language): int
{
  switch($language) {
  case 'en':
  case 'en_GB':
    $plural = ['num' => 2, 'rule' => 1];
    break;
  default:
    $plural = null;
    break;
  }
  return $plural;
}

