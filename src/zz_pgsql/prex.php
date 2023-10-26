<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/pgsql/prepare.php';
require_once SESTO_DIR . '/pgsql/execute.php';

function sesto_pgsql_prex(pgsql\connection $connection, string $stmt_name, string $query, array $params): pgsql\result|false
{
  $result = sesto_pgsql_prepare($connection, $stmt_name, $query);
  if ($result instanceof pgsql\result) {
    $result = sesto_pgsql_execute($connection, $stmt_name, $params);
  }
  return $result;
}
