<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/html/element.php';
require_once SESTO_DIR . '/html/build.php';

function sesto_html_option(array $options, $value): string
{
  $content = "\n";
  foreach ($options as $field_value => $field_label) {
    $option_attribs = ['value' => $field_value];
    if ($field_value === $value) {
      $option_attribs['selected'] = 'selected';
    }
    $content .= "\t" . sesto_html_build(sesto_html_element('option', $option_attribs, $field_label));
  }
  return $content;
}
