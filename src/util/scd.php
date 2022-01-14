<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/is_file_readable.php';

function sesto_scd(array $spc): array
{
  if (isset($spc['require'])) {
    if (!sesto_is_file_readable($spc['require'])) {
      throw new exception($spc['require'] . ' is not readable');
    }
    require_once $spc['require'];
  }
  if (!isset($spc['callable'])) {
    throw new exception('Callable not defined');
  }
  return [$spc['callable'], $spc['args'] ?? []];
}

