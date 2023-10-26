<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_scd_struct(array|string|object $callable, string $require = '', array $args = []): array
{
  return [
    'callable' => $callable,
    'require' => $require,
    'args' => $args
  ];
}
