<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

/* Note this function has been inspired from Zend Framework 1 (Zend_Filter_StringTrim) */

declare(strict_types=1);

function sesto_string_trim(string $value, string $charlist = '\\\\s'): string
{
  $chars = preg_replace(
    ['/[\^\-\]\\\]/S', '/\\\{4}/S', '/\//'],
    ['\\\\\\0', '\\', '\/'],
    $charlist
  );
  $pattern = '/^[' . $chars . ']+|[' . $chars . ']+$/usSD';
  return preg_replace($pattern, '', $value);
}
