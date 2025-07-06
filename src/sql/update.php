<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

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
