<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

function sesto_hook_function(array $hooks, string $name, &...$args)
{
  $result = null;
  $calls = $hooks[$name] ?? [];
  if (!empty($calls)) {
    ksort($calls, SORT_NUMERIC);
//    $args = [];
//    if(func_num_args() > 2) {
//      $args = array_slice(func_get_args(), 2);
//    }
    foreach ($calls as $block) {
      foreach ($block as $callback) {
        $result = $callback(...$args);
      }
    }
  }
  return $result;
}
