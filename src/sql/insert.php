<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

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

