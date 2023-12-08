<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_pgsql_error($conn = null): string
{
  $error = '';
  if ($conn instanceof pgsql\connection) {
    $error = (string) pg_last_error($conn);
    $pos = strpos($error, "\n");
    if (false !== $pos) {
      $error = substr($error, 0, $pos);
    }
  }
  return $error;
}
