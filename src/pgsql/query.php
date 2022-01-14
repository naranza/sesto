<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/type/check.php';

function sesto_pgsql_query($link, string $query)
{
  $error = sesto_type_check($link, 'pgsql link');
  if ('' !== $error) {
    throw new exception($error, 1000);
  }
  $result = @pg_query($link, $query);
  if (false === $result) {
    throw new exception((string) pg_last_error($link), 1002);
  }
  return $result;
}

