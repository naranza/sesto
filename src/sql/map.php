<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/sql/where.php';

function sesto_sql_map(array $map, array $record)
{
  $mapped = $record;
  foreach (array_keys($record) as $field) {
     if (isset($map[$field])) {
      $mapped[$field] = ':' . $field;
     }
  }
  return $mapped;
}
