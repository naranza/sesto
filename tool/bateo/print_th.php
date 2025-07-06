<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_print_th(throwable $th, bool $return = false): string
{
  $msg = sprintf("(%s:%d) %s", $th->getfile(), $th->getline(), $th->getmessage());
  if ($return) {
    $out = $msg;
  } else {
    echo $msg;
    $out = '';
  }
  return $out;
}
