<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/core/get_type.php';

function sesto_type_check($expression, string $expected): string
{
  $error = '';
  $got = sesto_get_type($expression);
  if ($expected !== $got) {
    $error = sprintf("Invalid type: '%s' expected '%s' got", $expected, $got);
  }
  return $error;
}

