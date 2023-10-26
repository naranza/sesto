<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/type/check.php';
require_once SESTO_DIR . '/pgsql/query.php';
require_once SESTO_DIR . '/pgsql/quote.php';

function sesto_sql_pgsql_is_prepared($link, string $name): bool
{
  $error = sesto_type_check($link, 'pgsql link');
  if ('' !== $error) {
    throw new exception($error, 1000);
  }
  return pg_num_rows(sesto_pgsql_query(
    $link,
    'SELECT name FROM pg_prepared_statements WHERE name = ' . sesto_pgsql_quote($name))
  ) > 0;
}

