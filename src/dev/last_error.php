<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_last_error()
{
  $e = error_get_last();
  if (null !== $e) {
    echo sprintf(
      '%s Last error: %s%s',
      (php_sapi_name() == "cli" ? '' : '<pre>'),
      print_r($e, true),
      (php_sapi_name() == "cli" ? '' : '</pre>'));
  }
}
