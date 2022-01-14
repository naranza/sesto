<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

class sesto_cache_fshandler
{

  private $dir;
  private $algo;

  public function __construct(string $dir, string $algo)
  {
    $this->dir = $dir;
    $this->algo = $algo;
  }

  private function get_hash(string $key)
  {
  }

  public function read(string $key): ?string
  {
    $hash = hash($this->algo, $key);

  }

  public function write(string $key, string $value, int $ttl = 0): bool
  {
    $hash = hash($this->algo, $key);
  }

  public function exists(string $key): bool

  {}
  public function expired(string $key, int $ttl): bool
  {}

}

