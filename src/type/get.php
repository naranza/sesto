<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_type_get($expression): string
{
  if (is_resource($expression)) {
    $result = get_resource_type($expression);
  } else if (is_object($expression)) {
    $result = get_class($expression);
  } else {
    $result = gettype($expression);
  }
  return $result;
}

