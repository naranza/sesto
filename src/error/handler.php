<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_error_handler(int $severity, string $message, string $file, int $line)
{
  if (!(error_reporting() & $severity)) {
    // This error code is not included in error_reporting, so let it fall
    // through to the standard PHP error handler
    return false;
  }
  throw new errorexception($message, 0, $severity, $file, $line);
}
