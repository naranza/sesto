<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/dev/dump.php';

function sesto_dump_app_error(throwable $throwable, array $args = []): string
{
  return sesto_dump(['throwable' => $throwable, 'args' => $args]);
}

