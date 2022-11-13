<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/format.php';

function bateo_wix($wie, $wig): string
{
  return sprintf('Expected: %s - Got: %s', bateo_format($wie), bateo_format($wig));
}
