<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/cache/driver.php';

class sesto_cache_memcache implements sesto_cache_driver
{

  private $server;
  public $found = false;

  public function __construct(Memcached $server)
  {
    $this->server = $server;
  }

  public function read(string $key)
  {
    $data = $this->server->get($key);
    if (Memcached::RES_SUCCESS != $this->server->getResultCode()) {
      $this->found = false;
      $data = null;
    } else {
      $this->found = true;
    }
    return $data;
  }

  public function write(string $key, $value, int $ttl = 0): bool
  {
    $result = $this->server->set($key, $value, $ttl);
    return Memcached::RES_SUCCESS != $this->server->getResultCode();
  }

  public function exists(string $key): bool
  {
    $this->server->get($key);
    return Memcached::RES_SUCCESS == $this->server->getResultCode();
  }

}

