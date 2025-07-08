<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_config_ini(string $filename, bool $process_sections = true, int $scanner_mode = INI_SCANNER_TYPED): array
{
  $config = [];
  if (is_file($filename) && is_readable($filename)) {
    $config = parse_ini_file($filename, $process_sections, $scanner_mode) ?: [];

  }
  return $config;
}
