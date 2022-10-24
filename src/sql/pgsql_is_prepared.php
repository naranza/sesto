<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_sql_pgsql_is_prepared(string $name): string
{
  return "select name from pg_prepared_statements where name = $name";
}

