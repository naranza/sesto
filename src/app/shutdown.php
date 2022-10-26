<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_app_shutdown()
{
  $e = error_get_last();
  if ($e !== NULL) {
    print_r(error_get_last());
    die;
  }
}
