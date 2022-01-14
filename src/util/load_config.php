<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) 2009-20 Andrea Davanzo - sesto.dev
 * License MPL v2.0. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_load_config(string $path, bool $strict = true): array
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
