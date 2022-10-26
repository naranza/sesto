<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_pgsql_fetch_all(pgsql\result $result, string $index = null): array
{
  $rows = [];
  $row = pg_fetch_assoc($result);
  if (!empty($row)) {
    if (null !== $index && !isset($row[$index])) {
      throw new exception(sprintf('Unable to fetch, the field %s does not exist', $index));
    } else {
      while (!empty($row)) {
        if (null === $index) {
          $rows[] = $row;
        } else {
          $rows[$row[$index]] = $row;
        }
        $row = pg_fetch_assoc($result);
      }
    }
  }
  return $rows;
}
