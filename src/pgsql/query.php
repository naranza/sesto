<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/core/env.php';
require_once SESTO_DIR . '/profile/sql.php';

function sesto_pgsql_query(pgsql\connection $connection, string $query): pgsql\result|false
{
  $start = microtime(true);
  $result = pg_query($connection, $query);
  if (true === sesto_env('sesto_profiler')) {
    sesto_profile_sql($query, microtime(true) - $start);
  }
  return $result;
}
