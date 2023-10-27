<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_http_get(): bool
{
  return 'GET' == ($_SERVER['REQUEST_METHOD'] ?? '');
}

