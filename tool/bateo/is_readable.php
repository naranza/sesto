<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

function bateo_is_readable(string $path): bool
{

  return is_file($path) && is_readable($path);
  
}
