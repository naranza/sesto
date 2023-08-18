<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_get_type($expression): string
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

