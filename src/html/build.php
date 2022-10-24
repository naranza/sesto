<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/html/void.php';
require_once SESTO_DIR . '/html/attribs.php';

function sesto_html_build( $element): string
{
  $html = '';
  if (!isset($element['tag'])) {
    sesto_d($element);
    die;
  }
//  if (isset($element['tag'])) {
    $tag = strtolower($element['tag']);
    $html = '<' . $element['tag'] . ' ' . sesto_html_attribs($element['attribs'] ?? []);
    if (isset(sesto_html_void()[$tag])) {
      $html .=  ' />';
    } else {
      $html .= '>' . ($element['content'] ?? '') . '</' . $tag . '>';
    }
//  }
  return $html;
}
