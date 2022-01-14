<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

function sesto_config(string $path, bool $strict = true): array
{
  $readable = is_file($path) && is_readable($path);
  if (!$readable && $strict) {
    throw new exception(sprintf("The path '%s' is not readable", $path));
  } elseif(!$readable && !$strict) {
    $result = [];
  } elseif($readable) {
    $result = @include($path);
    if (isset($config) && is_array($config)) {
      $result = $config;
    }
  }
  return $result;
}
