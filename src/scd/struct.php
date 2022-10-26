<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_scd_struct($callable, array $args = [], string $require = ''): array
{
  if (!is_array($callable) && !is_string($callable)) {
    throw new typeerror ('Argument 1 passed to sesto_scd_struct() must be of the type string or array');
  }
  return [
    'require' => $require,
    'callable' => $callable,
    'args' => $args
  ];
}
