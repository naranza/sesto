<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

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

