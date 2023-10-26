<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysqlstmt_extract(array $input, $extra_values = []): array
{
  $result = [
    0 => [], /* record */
    1 => '', /* types */
    2 => [] /* values */
  ];
  foreach($input as $field => $value) {
    $result[0][$field] = '?';
    $result[1] .= 's';
    $result[2][] = $value;
  }
  foreach($extra_values as $value) {
    $result[1] .= 's';
    $result[2][] = $value;
  }
  return $result;
}

