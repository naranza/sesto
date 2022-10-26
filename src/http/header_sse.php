<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_http_header_sse(): array
{
  return [
    'Content-Type: text/event-stream',
    'Cache-Control: no-cache',
    'Connection: keep-alive'
  ];
}