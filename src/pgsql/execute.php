<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/util/registry.php';
require_once SESTO_DIR . '/profile/sql.php';

function sesto_pgsql_execute(pgsql\connection $connection, string $stmtname, array $params, bool $profile = false): pgsql\result|false
{
  $start = microtime(true);
  $result = pg_execute($connection, $stmtname, $params);
  if ($profile) {
    sesto_profile_sql($stmtname, microtime(true) - $start, $params, 'execute');
  }
  return $result;
}
