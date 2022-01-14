<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

function sesto_url_query_args(string $url): array
{
  $result = [];
  $parts = explode('&', (string) parse_url($url, PHP_URL_QUERY));
  foreach($parts as $part) {
    $data = explode('=', $part);
    if (isset($data[0]) && isset($data[1])) {
      $result[$data[0]] = $data[1];
    }
  }
  return $result;
}

