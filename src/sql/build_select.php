<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/sql/select.php';
require_once SESTO_DIR . '/sql/build_where.php';

function sesto_sql_build_select(sesto_sql_select $select): string
{
  $sql = 'select';
  $sql .= ' ' . implode(', ', $select->cols);
  $sql .= ' from ' . $select->from;
  if (!empty($select->join)) {
    $sql .= ' ' . implode(' ', $select->join);
  }
  if (!empty($select->where)) {
    $sql .= ' where ' . sesto_sql_build_where($select->where);
  }
  if (!empty($select->group)) {
    $sql .= ' group by ' . implode(', ', $select->group);
  }
  if (!empty($select->order)) {
    $sql .= ' order by ' . implode(', ', $select->order);
  }
  if ($select->limit > 0) {
    $sql .= ' limit ' . $select->limit;
  }
  if ($select->offset > 0) {
    $sql .= ' offset ' . $select->offset;
  }
  return $sql;
}