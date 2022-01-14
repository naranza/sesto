<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_error_handler(int $severity, string $message, string $file, int $line, array $context)
{
  throw new errorexception($message, 0, $severity, $file, $line);
}

