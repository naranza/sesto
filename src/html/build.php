<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/html/void.php';
require_once SESTO_DIR . '/html/attribs.php';

function sesto_html_build(array $element): string
{
  if (!isset($element['tag'])) {
    throw new exception("tag index not found");
  } elseif (!isset($element['attribs'])) {
    throw new exception("attribs index not found");
  }
  $tag = strtolower($element['tag']);
  $html = '<' . $element['tag'] . ' ' . sesto_html_attribs($element['attribs']);
  if (isset(sesto_html_void()[$tag])) {
    $html .=  ' />';
  } else {
    $html .= '>' . $element['content'] . '</' . $tag . '>';
  }
  return $html;
}
