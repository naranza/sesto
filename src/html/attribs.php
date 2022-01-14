<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/html/normalise.php';

function sesto_html_attribs(array $attribs): string
{
  $parts = [];
  foreach ($attribs as $name => $value) {
    if (is_int($name)) {
      $parts[] = $value;
    } else {
      if ('id' == $name) {
        $value = sesto_html_normalise($value);
      }
      $parts[] = $name . '="' . $value . '"';
    }
  }
  return implode(' ', $parts);
}

