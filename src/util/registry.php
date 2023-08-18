<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_registry(string $name = null, $value = null): mixed
{
  /* init */
  static $cache = [];
  $num_args = func_num_args();
  if (0 === $num_args) {
    /* return cache */
    return $cache;
  } else if (1 === $num_args) {
    /* get */
    return $cache[$name] ?? null;
  } elseif (2 === $num_args) {
    if (null === $value) {
      /* delete */
      unset($cache[$name]);
    } else {
      /* set */
      $cache[$name] = $value;
    }
    return null;
  } else {
    /* do nothing */
    return null;
  }
}
