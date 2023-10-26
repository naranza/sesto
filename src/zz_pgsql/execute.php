<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/core/env.php';
require_once SESTO_DIR . '/profile/sql.php';

function sesto_pgsql_execute(pgsql\connection $connection, string $stmtname, array $params): pgsql\result|false
{
  $start = microtime(true);
  $result = pg_execute($connection, $stmtname, $params);
  if (true === sesto_env('sesto_profiler')) {
    sesto_profile_sql($stmtname, microtime(true) - $start, $params, 'execute');
  }
  return $result;
}
