<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_string_trim($value, $charlist = '\\\\s')
{
  $chars = preg_replace(
    ['/[\^\-\]\\\]/S', '/\\\{4}/S', '/\//'],
      ['\\\\\\0', '\\', '\/'],
      $charlist
    );
  $pattern = '/^[' . $chars . ']+|[' . $chars . ']+$/usSD';
  return preg_replace($pattern, '', $value);
}

