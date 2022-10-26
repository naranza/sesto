<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

/* Note this function has been taken from Zend Framework as is. See Filter_StringTrim */

declare(strict_types=1);

function sesto_string_trim(string $value, $charlist = '\\\\s'): string
{
  $chars = preg_replace(
    ['/[\^\-\]\\\]/S', '/\\\{4}/S', '/\//'],
      ['\\\\\\0', '\\', '\/'],
      $charlist
    );
  $pattern = '/^[' . $chars . ']+|[' . $chars . ']+$/usSD';
  return preg_replace($pattern, '', $value);
}
