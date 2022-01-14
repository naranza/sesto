<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_url_path(): string
{
  $url = $_SERVER['REQUEST_URI'] ?? '';
  /* remove the query string */
  if (isset($_SERVER['QUERY_STRING'])) {
    $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $url);
  }
  return $url;
}

