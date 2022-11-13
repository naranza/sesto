<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

function bateo_is_readable(string $path): bool
{

  return is_file($path) && is_readable($path);

}
