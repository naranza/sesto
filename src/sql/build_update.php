<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/sql/update.php';
require_once SESTO_DIR . '/sql/build_where.php';

function sesto_sql_build_update(sesto_sql_update $update, bool $prepared = true): string
{
  $set = [];
  foreach ($update->record as $field => $value) {
    if ($prepared) {
      if (is_array($value)) {
        $set[] = $field . ' = ' . $value[0];
      } else {
        $set[] = $field . ' = :' . $field;
      }
    } else {
      $set[] = $field . ' = ' . $value;
    }
  }
  $sql = 'update ' . $update->table . ' set ' . implode(', ', $set);
  if (!empty($update->where)) {
    $sql .= ' where ' . sesto_sql_build_where($update->where);
  }
  if (!empty($update->returning)) {
    $sql .= ' returning ' . implode(', ', $update->returning);
  }
  return $sql;
}