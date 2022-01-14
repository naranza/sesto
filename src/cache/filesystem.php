<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/cache/driver.php';

class sesto_cache_filesystem implements sesto_cache_driver
{

  public function read(string $key): ?string
  {
    $result = @file_get_contents($key);
    if (false === $result) {
      $result = null;
    }
    return $result;
  }

  public function write(string $key, string $value, int $ttl = 0): bool
  {
    $result = false;
    $fp = @fopen($key, 'w');
    if ($fp !== false) {
      $result = fwrite($fp, $value);
      if (false !== $result) {
        $result = fclose($fp);
      }
    }
    return $result;
  }

  public function exists(string $key): bool
  {
    return file_exists($key);
  }

  public function expired(string $key, int $ttl): bool
  {
    $created = file_exists($key) ? @filemtime($key) : 0;
    return time() > $ttl + $created;
  }

}

