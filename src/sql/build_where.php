<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_sql_build_where(array $where, bool $prepared = true): string
{
  if (empty($where)) {
    return '';
  }
  $terms = [];
  foreach ($where as $key => $term) {
    if ($prepared) {
      if (isset($term[1])) {
        $terms[] = '(' . $term[0] . ' :' . $key . ')';
      } else {
        $terms[] = '(' . $term[0] . ')';
      }
    } else {
      $terms[] = '(' . $term[0] . ')';
    }
  }
  return implode(' and ', $terms);
}