<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_sql_build_where(array $where): string
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