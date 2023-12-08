<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_pgsql_quote(pgsql\connection $connection, $value)
{
  if (is_int($value) || is_float($value) || is_double($value)) {
    return $value;
  }
  if (is_bool($value)) {
    return "'" . ($value ? 't' : 'f') . "'";
  }
  return "'" . pg_escape_string($connection, $value) . "'";
}
