<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_spc_require(array $spc): void
{
  if (isset($spc['require'])) {
    if (!sesto_is_file_readable($spc['require'])) {
      throw new exception($spc['require'] . ' is not readable');
    }
    require_once $spc['require'];
  }
}
