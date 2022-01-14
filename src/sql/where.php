<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_sql_where(array $where): string
{
  if (empty($where)) {
    return '';
  }
  $terms = [];
  foreach ($where as $term) {
    $terms[] = '(' . $term . ')';
  }
  return implode(' and ', $terms);
}
