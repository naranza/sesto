<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/util/error_handler.php';

function sesto_pgsql_connect(
  string $hostname,
  string $username,
  string $password,
  string $database,
  array $options = [],
  string &$error = ''): pgsql\connection|false
{
  $error = '';
  /* generate conncetion string */
  $string = 'host=' . $hostname ?? '';
  if (is_string(($options['port'] ?? null))) {
    $string .= ' port=' . $options['port'];
  }
  $string .= ' dbname=' . $database ?? '';
  $string .= ' user=' . $username ?? '';
  $string .= ' password=' . $password ?? '';
  if (is_string(($options['sslmode'] ?? null))) {
    $string .= ' sslmode=' . $options['sslmode'];
  }
  if (is_string(($options['client_encoding'] ?? null))) {
    $string .= " options='--client_encoding={$options['client_encoding']}'";
  }

  /* connect */
  try {
    set_error_handler('sesto_error_handler');
    $connection = pg_connect($string);
  } catch (exception $ex) {
    $error = $ex->getmessage();
    $connection = false;
  } finally {
    restore_error_handler();
  }
  return $connection;
}
