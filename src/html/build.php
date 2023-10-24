<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/html/void.php';
require_once SESTO_DIR . '/html/attribs.php';

function sesto_html_build(array $element): string
{
  $html = '';
  if (isset($element['tag'])) {
    $tag = strtolower($element['tag']);
    $html = '<' . $element['tag'] . ' ' . sesto_html_attribs($element['attribs'] ?? []);
    if (isset(sesto_html_void()[$tag])) {
      $html .=  ' />';
    } else {
      $html .= '>' . ($element['content'] ?? '') . '</' . $tag . '>';
    }
  }
  return $html;
}
