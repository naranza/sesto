<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

function bateo_error_handler(int $severity, string $message, string $file, int $line)
{
  throw new errorexception($message, 0, $severity, $file, $line);
}
