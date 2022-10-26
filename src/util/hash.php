<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_hash(string $algo, $data, bool $binary = false): string
{
  $hashed = hash($algo, serialize($data), $binary);
  if (false === $hashed) {
    $hashed = '';
  }
  return $hashed;
}
