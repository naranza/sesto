<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once BATEO_DIR . '/format.php';

function bateo_wix(mixed $wie, mixed $wig): string
{
  return sprintf('Expected: %s - Got: %s', bateo_format($wie), bateo_format($wig));
}
