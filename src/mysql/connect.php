<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysql_connect(
  string $hostname,
  string $database,
  string $username,
  string $password,
  array $options = []): mysqli
{
  $connection = null;
  $port = $options['port'] ?? '';
  $encoding = $options['encoding'] ?? '';

  if ('' !== $port) {
    $connection = @mysqli_connect($hostname, $username, $password, $database, $port);
  } else {
    $connection = @mysqli_connect($hostname, $username, $password, $database);
  }
  if ('' !== $encoding) {
    $connection->set_charset($encoding);
    mysqli_query($connection, "set names '$encoding'");
    mysqli_query($connection, "set character set $encoding");
  }
  return $connection;
}

