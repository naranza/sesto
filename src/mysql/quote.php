<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_mysql_quote(mysqli $connection, string $value): string
{
  if (is_int($value) || is_float($value)) {
    return $value;
  }
  if (!is_string($value)) {
    throw new exception('Invalid type');
  }
  return "'" . mysqli_real_escape_string($connection, $value) . "'";
}
