<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/html/void.php';
require_once SESTO_DIR . '/html/attribs.php';

class sesto_html_ele implements stringable
{

  public string $tag = '';
  public array $attribs = [];
  public string $content = '';

  public function __construct(string $tag, array $attribs = [], string $content = '')
  {
    $this->tag = $tag;
    $this->attribs = $attribs;
    $this->content = $content;
  }

  public function build(): string
  {
    $html = '';
    $this->tag = strtolower($this->tag);
    $html = '<' . $this->tag . ' ' . sesto_html_attribs($this->attribs);
    if (isset(sesto_html_void()[$this->tag])) {
      $html .= ' />';
    } else {
      $html .= '>' . ($this->content) . '</' . $this->tag . '>';
    }
    return $html;
  }

  public function __toString(): string
  {
    return $this->build();
  }
}
