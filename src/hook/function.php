<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_hook_function(array $hooks, string $name, ...$args)
{
  $result = null;
  $calls = $hooks[$name] ?? [];
  ksort($calls, SORT_NUMERIC);
  foreach ($calls as $block) {
    foreach ($block as $callback) {
      $result = $callback(...$args);
    }
  }
  return $result;
}
