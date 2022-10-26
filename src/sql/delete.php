<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/sql/where.php';

function sesto_sql_delete(string $table, array $where = null)
{
  $sql = 'delete from ' . $table;
  if (!empty($where)) {
    $sql .= ' where ' . sesto_sql_where($where);
  }
  return $sql;
}
