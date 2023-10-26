<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_json_pprint(string $json): string
{
  $data = json_decode($json);
  if (null !== $data) {
    $out = json_encode($data, JSON_PRETTY_PRINT);
    if (false === $out) {
      $out = '';
    }
  } else {
    $out = '';
  }
  return $out;
}
