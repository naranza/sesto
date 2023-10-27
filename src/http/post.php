<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_http_post(): bool
{
  return 'POST' == ($_SERVER['REQUEST_METHOD'] ?? '');
}

