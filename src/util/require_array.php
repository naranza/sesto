<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_require_array(array $config, bool $once = true): void
{
  foreach ($config as $path) {
    $once ? require_once $path : require $path;
  }
}
