<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_html_element(string $tag, array $attribs = [], string $content = ''): array
{
  return [
    'tag' => $tag,
    'attribs' => $attribs,
    'content' => $content];
}
