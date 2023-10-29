<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_config(string $path): false|array
{
  $path .= 'php' != pathinfo($path, PATHINFO_EXTENSION) ? '.php' : '';
  if (is_file($path) && is_readable($path)) {
    $result = include($path);
    if (isset($config) && is_array($config)) {
      $result = $config;
    } elseif (!is_array($result)) {
      $result = false;
    }
  } else {
    $result = false;
  }
  return $result;
}