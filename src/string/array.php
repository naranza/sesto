<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_replace_array(string $pattern, array $input): string
{
  $output = $input;
  foreach ($input as $value) {
    @preg_match_all($pattern, $value, $matches);
    foreach ($matches[0] as $token) {
      $key = trim($token, '%');
      $output = str_replace($token, $this->getValue($key), $output);
    }
  }
  return $output;
}

