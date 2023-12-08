<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/util/registry.php';
require_once SESTO_DIR . '/profile/sql.php';

function sesto_pgsql_prepare(pgsql\connection $connection, string $stmtname, string $query): pgsql\result|false
{
  $start = microtime(true);
  $result = pg_prepare($connection, $stmtname, $query);
  if (true === sesto_registry('sesto_profiler')) {
    sesto_profile_sql($query, microtime(true) - $start, [], 'prepare');
  }
  return $result;
}
