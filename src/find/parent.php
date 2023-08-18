<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_find_parent(string $path, string $filename): string
{
  $parts = explode(DIRECTORY_SEPARATOR, $path);
  array_pop($parts);
  $result = '';
  if ([] !== $parts) {
    $file_to_include = implode(DIRECTORY_SEPARATOR, $parts) . DIRECTORY_SEPARATOR . $filename;
    if (is_file($file_to_include) && is_readable($file_to_include)) {
      $result = $file_to_include;
    } else {
      $result = sesto_find_parent(implode(DIRECTORY_SEPARATOR, $parts), $filename);
    }
  }
  return $result;
}
