<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/html/element.php';
require_once SESTO_DIR . '/html/build.php';

function sesto_html_select(array $attribs = [], $value, array $options = [])
{
  $content = "\n";
  foreach ($options as $field_value => $field_label) {
    $option_attribs = ['value' => $field_value];
    if ($field_value === $value) {
      $option_attribs[] = 'selected';
    }
    $content .= "\t" . sesto_html_build(sesto_html_element('option', $option_attribs, $field_label));
  }
  return sesto_html_build(sesto_html_element('select', $attribs, $content));
}

