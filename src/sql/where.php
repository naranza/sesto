<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

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
