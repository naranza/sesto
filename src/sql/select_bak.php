<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/sql/where.php';

class sesto_sql_select
{

  private $part = [
    'cols' => [],
    'from' => [],
    'joins' => [],
    'where' => [],
    'group' => [],
    'order' => [],
    'limit' => []];

  public function add_col(string $col)
  {
    $this->part['cols'][] = $col;
  }

  public function set_from(string $from)
  {
    $this->part['from'][] = $from;
  }

  public function add_where(string $where)
  {
    $this->part['where'][] = $where;
  }

  public function add_join(string $type, string $identifier, string $condition)
  {
    $this->part['joins'][] = [$type, $identifier, $condition];
  }

  public function add_group(string $reference)
  {
    $this->part['group'][] = $reference;
  }

  public function add_order($expression)
  {
    $this->part['order'][] = $expression;
  }

  public function add_limit($count)
  {
    $this->part['limit'] = $count;
  }

  public function add_offset($start)
  {
    $this->part['offset'] = $start;
  }

  /**
   * reset all SQL parts
   */
  public function reset()
  {
    $this->part['cols'] = [];
    $this->part['from'] = '';
    $this->part['joins'] = [];
    $this->part['where'] = [];
    $this->part['group'] = [];
    $this->part['order'] = [];
    $this->part['limit'] = [];
    $this->part['offset'] = [];
  }


  public function select(
    array $cols,
    array $from,
    array $joins = null,
    array $where = null,
    array $group = null,
    array $order = null,
    string $limit = null): string
  {
    $sql = 'select';
    $sql .= ' ' . implode(', ', $cols);
    $sql .= ' from ' . implode('', $from);
    if (null !== $join) {
      $sql .= ' ' . implode(' ', $joins);
    }
    if (null !== $where) {
      $sql .= ' where ';
      $sql .= ' ' . implode(' and ', $where);
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

}
