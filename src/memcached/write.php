<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_memcached_write(Memcached $server, string $key, $value, int $ttl = 0): bool
{
  $result = $server->set($key, $value, $ttl);
  return $result && Memcached::RES_SUCCESS == $server->getresultcode();
}

