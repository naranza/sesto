<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_memcached_read(Memcached $server, string $key, bool &$found = false)
{
  $data = $server->get($key);
  if (Memcached::RES_SUCCESS != $server->getresultcode()) {
    $found = false;
    $data = null;
  } else {
    $found = true;
  }
  return $data;
}
