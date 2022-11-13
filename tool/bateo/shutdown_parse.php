<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types=1);

function bateo_shutdown_parse(string $path, int $shutdown_errors): void
{
  if ($shutdown_errors > 0) {
    if (is_file($path) && is_readable($path)) {
      $handle = fopen($path, 'r');
      if ($handle) {
        echo "== Shutdown summary\n";
        echo sprintf("Errors found: %d\n", $shutdown_errors);
        while (false !== ($line = fgets($handle))) {
          $error = json_decode(str_replace("\n", "", $line), true);
          echo sprintf("%s\n", str_replace("    ", "  ", print_r($error, true)));
        }
        fclose($handle);
      }
    }
  }
}
