<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once BATEO_DIR . '/print_r.php';

function bateo_dump($expression, string $label = '', bool $return = false): string
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
  $idx = $bt[1] ? 1 : 0;
  $out .= '[' . pathinfo($bt[$idx]['file'], PATHINFO_FILENAME);
  $out .= ':' . $bt[$idx]['line'] . ']';
  if ('' != $label) {
    $out .= ' ' . $bold_start . $label . $bold_end;
  }
  $out .= ': ' . bateo_print_r($expression, true);
  $out .= $block_end;
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}

function bateo_d($expression, string $label = '', bool $return = false): string
{
  return bateo_dump($expression, $label, $return);
}
