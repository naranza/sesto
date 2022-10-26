<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_http_redirect(string $url, int $response_code = 303): void
{
  if (!(bool) preg_match('/\S/', $url)) {
    throw new exception('Empty redirect url');
  }
  header("Status: " . $response_code, true);
  header("Location: " . $url, true, $response_code);
}
