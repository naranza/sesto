<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_dirs(string $name = null, string $dir = null): array|string
{
  static $dirs = [];

  if (null === $name && null === $dir) {
    /* return all dirs */
    return $dirs;
  } else if (null !== $name && null === $dir) {
    /* return dir by name */
    return $dirs[$name] ?? '';
  } elseif (null !== $name && null !== $dir) {
    /* set dir by name */
    $dirs[$name] = $dir;
    return '';
  } else {
    return '';
  }
}
