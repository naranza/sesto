<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

function bateo_load_config(string $path): array
{
  if (!is_file($path) && is_readable($path)) {
    throw new exception(sprintf('%s path is not readable', $path));
  } else {
    include($path);
    if (!isset($config)) {
      throw new exception(sprintf('$config array not defined on %s', $path));
    }
  }
  return $config;
}
