<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysqlstmt_upsert(array $input, string $types, array $values): array
{
  list($ub_record, $ub_types, $ub_values) = sesto_mysqlstmt_extract($input);
  $upsert_types =  $types . $ub_types;
  $upsert_values =  array_merge($values, $ub_values);

  $result = [
    0 => $upsert_types,
    1 => $upsert_values
  ];

  return $result;
}

