<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/dev/print_r.php';

function sesto_dump($expression, string $label = '', bool $return = false): string
{
  $block_start = '<pre>';
  $block_end = '</pre>';
  $bold_start = '<strong>';
  $bold_end = '</strong>';
  if ('cli' == php_sapi_name()) {
    $block_start = '';
    $block_end = "\n";
    $bold_start = '';
    $bold_end = '';
  }
  $out = $block_start;
  $bt = debug_backtrace();
  $idx = 0;
  $out .= '[' . pathinfo($bt[$idx]['file'], PATHINFO_FILENAME);
  $out .= ':' . $bt[$idx]['line'] . ']';
  if ('' != $label) {
    $out .= ' ' . $bold_start . $label . $bold_end;
  }
  $out .= ': ' . sesto_print_r($expression, true);
  $out .= $block_end;
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}

