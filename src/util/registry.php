<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_registry(string $name = null, $value = null): mixed
{
  /* init */
  static $cache = [];
  if ($name === null) {
    /* return cache */
    return $cache;
  } else if (is_string($name) && $value === null) {
    /* get */
    return $cache[$name] ?? null;
  } else {
    if (null === $value) {
      /* delete */
      unset($cache[$name]);
    } else {
      /* set */
      $cache[$name] = $value;
    }
    return null;
  }
}
