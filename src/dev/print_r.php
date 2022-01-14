<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/dev/specialchars.php';

function sesto_print_r($expression, bool $return = false): string
{
  $out = '';
  if (is_null($expression)) {
    $out = 'null';
  } elseif (is_bool($expression)) {
    $out = '(boolean) ' . ($expression ? 'true' : 'false');
  } elseif (is_int($expression) || is_float($expression) || is_double($expression)) {
    $out = '(' . gettype($expression) . ') ' . $expression;
  } elseif (is_string($expression)) {
    $out = sprintf(
      '(string c%d,b%d) %s',
      mb_strlen($expression),
      strlen($expression),
      sesto_specialchars($expression));
  } else {
    $out = sesto_specialchars(print_r($expression, true));
  }
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}
