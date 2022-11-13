<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

function bateo_find_scandir(string $dir, bateo_datalist_interface $datalist)
{
  $root = array_diff(scandir($dir), ['..', '.']);
  foreach ($root as $value) {
    if (is_file("$dir/$value")) {
      if (1 == preg_match('/_test\.php$/', "$dir/$value")) {
        $datalist->write(realpath("$dir/$value"));
      }
    } else {
      bateo_find_scandir("$dir/$value", $datalist);
    }
  }
}
