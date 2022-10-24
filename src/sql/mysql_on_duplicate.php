<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysql_on_duplicate(array $input): string
{
  $sql = ' on duplicate key update ';
  $set = [];
  foreach ($input as $field => $value) {
    $set[] = $field . ' = ?';
  }
  $sql .= implode(', ', $set);
  return $sql;
}

