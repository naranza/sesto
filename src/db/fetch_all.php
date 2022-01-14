<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_fetch_all($connection, string $key = null)
{
  $data = [];
  if (is_resource($connection)) {
    $restype = get_resource_type($connection);
    if ('pgsql result' == $restype) {
      $callable = ['pg_fetch_array', [$connection], null, PGSQL_ASSOC];
    }
  }
  sesto_dump(get_resource_type($connection));
  die;
  while ($row = $result->fetch_row()) {
    if (null === $key) {
      $data[] = $row;
    } else {
      if (!array_key_exists($key, $row)) {
        throw new exception(sprintf("Fetch error. Key %s does not exists", $key));
      }
      $data[$row[$key]] = $row;
    }
  }
  return $data;
}
