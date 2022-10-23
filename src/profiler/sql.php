<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_profiler_sql(string $query = null, float $elapsed = 0.0, array $params = [], string $type = 'query'): null|array
{
  static $sqls = [];
  if (null === $query) {
    return $sqls;
  } else {
    $sqls[] = ['sql' => $query, 'elapsed' => $elapsed, 'params' => $params, 'type' => $type];
    return null;
  }
}
