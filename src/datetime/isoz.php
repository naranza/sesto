<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

function sesto_datetime_isoz(datetime $datetime): string
{
  $out = $datetime->format('Y-m-d\TH:i:s');
  if ('UTC' === $datetime->gettimezone()->getname()) {
    $out .= 'Z';
  } else {
    $out .= $datetime->format('P');
  }
  return $out;
}

