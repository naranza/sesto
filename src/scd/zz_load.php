<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_scd_load(array $spc): array
{
  if (isset($spc['require'])) {
    if (!is_file($spc['require']) || !is_readable($spc['require'])) {
      throw new exception($spc['require'] . ' is not readable');
    }
    require_once $spc['require'];
  }
  return [$spc['callable'] ?? '', $spc['args'] ?? []];
}
