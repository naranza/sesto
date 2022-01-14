<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_env_path(string $path, string $env): string
{
  $pinfo = pathinfo($path);
  $dirname = $pinfo['dirname'] ?? '';
  $basename = $pinfo['basename'] ?? '';
  $extension = $pinfo['extension'] ?? 'php';
  $filename = $pinfo['filename'] ?? '';
  $return = $dirname . '/'. $filename;
  if ('' !== $env) {
    $return .= '-'. $env ;
  }
  return $return . '.' . $extension;
}

