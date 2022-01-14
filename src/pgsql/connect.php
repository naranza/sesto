<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/error_handler.php';

function sesto_pgsql_connect(
  string $hostname,
  string $username,
  string $password,
  string $database,
  array $options = [])
{
  $connection = null;
  $port = $options['port'] ?? '';
  $string = 'host=' . $hostname ?? '';
  if ('' != $port) {
    $string .= ' port=' . $port;
  }
  $string .= ' dbname=' . $database ?? '';
  $string .= ' user=' . $username ?? '';
  $string .= ' password=' . $password ?? '';
  if (isset($options['client_encoding'])) {
    $string .= " options='--client_encoding={$options['client_encoding']}'";
  }
  try {
    set_error_handler('sesto_error_handler');
    $conn = @pg_connect($string);
  } catch (exception $ex) {
    throw new exception($ex->getmessage(), 1001);
  } finally {
    restore_error_handler();
  }
  return $conn;
}

