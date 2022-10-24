<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_html_option(array $options, $value): array
{
  $result = [];
  foreach ($options as $field_value => $field_label) {
    $option_attribs = ['value' => $field_value];
    if ($field_value === $value) {
      $option_attribs[] = 'selected';
    }
    $result[] = sesto_html_element('option', $option_attribs, $field_label);
  }
  return $result;
}
