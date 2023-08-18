<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_url_path(): string
{
  $url = $_SERVER['REQUEST_URI'] ?? '';
  /* remove the query string */
  if (isset($_SERVER['QUERY_STRING'])) {
    $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $url);
  }
  return $url;
}
