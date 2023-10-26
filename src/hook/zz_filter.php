<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_hook_filter(array $hooks, string $name, $value): mixed
{
  $filtered = $value;
  $calls = $hooks[$name] ?? [];
  if (!empty($calls)) {
    ksort($calls, SORT_NUMERIC);
    $args = [];
    if (func_num_args() > 3) {
      $args = array_slice(func_get_args(), 3);
    }
    foreach ($calls as $block) {
      foreach ($block as $callback) {
        $filtered = $callback($filtered, ...$args);
      }
    }
  }
  return $filtered;
}
