<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_html_normalise(string $id): string
{
  if ('[]' == substr($id, -2)) {
    $id = substr($id, 0, strlen($id) - 2);
  }
  $id = rtrim($id, ']');
  $id = str_replace('][', '-', $id);
  $id = str_replace('[', '-', $id);
  return $id;
}
