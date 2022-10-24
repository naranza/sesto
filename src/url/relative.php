<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_url_relative(string $url_path, string $url_base): string
{
  $result = $url_path;
  if ('/' !== $url_base) {
    $result = preg_replace('#' . $url_base . '#', '', $url_path, 1);
  }
  return $result;
}
