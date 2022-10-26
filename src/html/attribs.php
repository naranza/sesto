<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/html/boolean.php';
require_once SESTO_DIR . '/html/normalise.php';

function sesto_html_attribs(array $attribs): string
{
  $parts = [];
  foreach ($attribs as $name => $value) {
    if ('id' == $name) {
      $value = sesto_html_normalise($value);
    }
    if (isset(sesto_html_boolean()[$name])) {
      $parts[] = $name;
    } else {
      $parts[] = $name . '="' . $value . '"';
    }
  }
  return implode(' ', $parts);
}
