<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_app_env(string $name = null, $value = null): mixed
{
  /* init */
  static $cache = [];
  $num_args = func_num_args();
  if (0 === $num_args) {
    return $cache;
  } else if (1 === $num_args) {
    return $cache[$name] ?? null;
  } elseif (2 === $num_args) {
    $cache[$name] = $value;
    return null;
  } else {
    return null;
  }
}
