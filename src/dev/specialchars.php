<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);
declare(strict_types = 1);

function sesto_specialchars(string $string): string
{
  if ('cli' == php_sapi_name()) {
    return $string;
  } else {
    return htmlspecialchars($string, ENT_COMPAT | ENT_HTML5, 'UTF-8');
  }
}
