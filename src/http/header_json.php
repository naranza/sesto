<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_http_header_json(): array
{
  return [
    'Content-Type: application/json',
    'Expires: on, 01 Jan 1970 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D, d M Y H:i:s") . " GMT",
    'Cache-Control: no-store, no-cache, must-revalidate',
    'Pragma: no-cache'
  ];
}
