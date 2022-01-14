<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/sql/where.php';

function sesto_sql_update(string $table, array $record, array $where = null)
{
  $set = [];
  foreach ($record as $field => $value) {
    $set[] = $field . ' = ' . $value;
  }
  $sql = 'update ' . $table . ' set ' . implode(', ', $set);
  if (!empty($where)) {
    $sql .= ' where ' . sesto_sql_where($where);
  }
  return $sql;
}

