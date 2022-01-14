<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_sql_insert(string $table, array $record): string
{
  $cols = array_keys($record);
  $vals = array_values($record);

  $sql = "insert into ";
  $sql .= $table;
  $sql .= ' (' . implode(', ', $cols) . ') ';
  $sql .= 'values (' . implode(', ', $vals) . ')';
  return $sql;
}

