<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_html_normalise(string $id): string
{
  if ('[]' == substr($id, -2)) {
    $id = substr($id, 0, strlen($id) - 2);
  }
  $id = rtrim($id, ']');
  $id = str_replace('][', '-', $id);
  $id = str_replace('[', '-', $id);
  return $id;
}

