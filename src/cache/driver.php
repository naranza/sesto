<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

interface sesto_cache_driver
{
  public function read(string $key);

  public function write(string $key, $value, int $ttl = 0): bool;

  public function exists(string $key): bool;

  /* public function expired(string $key, int $ttl): bool; */

}

