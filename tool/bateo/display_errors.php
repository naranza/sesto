<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_display_errors(int $error_reporting)
{
  ini_set('display_errors', 'true');
  ini_set('track_errors', 'true');
  ini_set('display_startup_errors', 'true');
  error_reporting($error_reporting);
}
