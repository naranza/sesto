<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_display_errors(bool $display = false)
{
  if ($display) {
    ini_set('display_errors', 'true');
    ini_set('track_errors', 'true');
    ini_set('display_startup_errors', 'true');
    error_reporting(E_ALL);
  } else {
    ini_set('display_errors', 'false');
    ini_set('track_errors', 'false');
    ini_set('display_startup_errors', 'false');
    error_reporting(0);
  }
}

