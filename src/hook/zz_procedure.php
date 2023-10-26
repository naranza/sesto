<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_hook_procedure(array $hooks, string $name, &...$args): void
{
  $calls = $hooks[$name] ?? [];
  if (!empty($calls)) {
    ksort($calls, SORT_NUMERIC);
    foreach ($calls as $block) {
      foreach ($block as $callback) {
        $callback(...$args);
      }
    }
  }
}
