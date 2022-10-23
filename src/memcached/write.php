<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_memcached_write(Memcached $server, string $key, $value, int $ttl = 0): bool
{
  $result = $server->set($key, $value, $ttl);
  return $result && Memcached::RES_SUCCESS == $server->getresultcode();
}
