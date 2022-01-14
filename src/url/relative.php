<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_url_relative(string $url_path, string $url_base): string
{
  $result = $url_path;
  if ('/' !== $url_base) {
    $result = preg_replace('#' . $url_base . '#', '', $url_path, 1);
  }
  return $result;
}

