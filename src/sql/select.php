<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_sql_select(
  array $cols,
  string $from = null,
  array $join = null,
  array $where = null,
  array $group = null,
  array $order = null,
  string $limit = null): string
{
  $sql = 'select';
  $sql .= ' ' . implode(', ', $cols);
  $sql .= ' from ' . $from;
  if (null !== $join) {
    $sql .= ' ' . implode(' ', $joins);
  }
  if (null !== $where) {
    $sql .= ' where ' . implode(' and ', $where);
  }
  if (null !== $group) {
    $sql .= ' group by ' . implode(', ', $group);
  }
  if (null !== $order) {
    $sql .= ' order by ' . implode(', ', $order);
  }
  if (null !== $limit) {
    $sql .= ' limit ' . $limit;
  }
  return $sql;
}

