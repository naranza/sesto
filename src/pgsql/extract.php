<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_pgsql_extract(array $record, $extra = []): array
{
  $result = [
    0 => [], /* record */
    1 => [] /* values */
  ];
  $pos = 1;
  foreach ($record as $field => $value) {
    if (is_array($value)) {
      $result[0][$field] = reset($value);
    } else {
      $result[0][$field] = '$' . $pos;
      $result[1][] = $value;
      $pos++;
    }
  }
  foreach ($extra as $value) {
    $result[1][] = $value;
  }
  return $result;
}
