<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

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
