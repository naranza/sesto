<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_ob_include(string $path): string
{
  ob_start();
  include $path;
  return ob_get_clean() ?: '';
}
