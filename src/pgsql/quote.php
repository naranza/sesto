<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/type/check.php';

function sesto_pgsql_quote($link, $value)
{
  if (is_int($value) || is_float($value) || is_double($value)) {
    return $value;
  }
  if (is_bool($value)) {
    return "'" . ($value ? 't' : 'f') . "'";
  }
  $error = sesto_type_check($value, 'string');
  if ('' !== $error) {
    throw new exception($error, 1000);
  }
  $error = sesto_type_check($link, 'pgsql link');
  if ('' !== $error) {
    throw new exception($error, 1000);
  }
  return "'" . pg_escape_string($link, $value) . "'";
}

