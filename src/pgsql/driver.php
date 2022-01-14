<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/db/driver.php';
require_once SESTO_DIR . '/db/check_connect_config.php';
require_once SESTO_DIR . '/db/check_valid_link.php';
require_once SESTO_DIR . '/pgsql/result.php';
require_once SESTO_DIR . '/util/error_handler.php';

final class sesto_pgsql_driver implements sesto_db_driver
{

  public $link;

  private function get_error(): string
  {
    return is_resource($this->link) ? (string) pg_last_error($this->link) : '';
  }

  public function connect(array $config)
  {
    $this->link = null;
    $port = $config['port'] ?? '';
    $timezone = $config['timezone'] ?? '';
    $encoding = $config['encoding'] ?? '';

    $errors = sesto_db_check_connect_config($config);
    if (!empty($errors)) {
      throw new exception(implode(', ', $errors));
    }
    /* set_error_handler(array($this, 'connect_error_handler')); */
    $string = 'host=' . $config['hostname'] ?? '';
    $string .= ' dbname=' . $config['database'] ?? '';
    $string .= ' user=' . $config['username'] ?? '';
    $string .= ' password=' . $config['password'] ?? '';
    // encoding
    if (isset($config['client_encoding'])) {
      $string .= " options='--client_encoding={$config['client_encoding']}'";
    }
    try {
      set_error_handler('sesto_error_handler');
      $this->link = @pg_connect($string);
      if ('' !== $timezone) {
        $this->query('SET TIME ZONE ' . $this->quote($timezone));
      }
    } catch (exception $ex) {
      throw new exception($ex->getmessage());
    } finally {
      restore_error_handler();
    }
  }

  public function close()
  {
    $error = sesto_db_check_valid_link(is_resource($this->link));
    if ('' !== $error) {
      throw new exception($error);
    }
    $result = @pg_close($this->link);
    if (false === $result) {
      throw new exception($this->get_error());
    }
    return $result;
  }

  public function escape(string $string): string
  {
    $error = sesto_db_check_valid_link(is_resource($this->link));
    if ('' !== $error) {
      throw new exception($error);
    }
    return pg_escape_string($this->link, $string);
  }

  public function query(string $query)
  {
    $error = sesto_db_check_valid_link(is_resource($this->link));
    if ('' !== $error) {
      throw new exception($error);
    }
    $result = @pg_query($this->link, $query);
    if (false === $result) {
      $error = $this->get_error();
      throw new exception($error);
    } else {
      return new sesto_pgsql_result($result);
    }
    return $result;
  }

  public function quote($value)
  {
    if (is_int($value) || is_float($value) || is_double($value)) {
      return $value;
    }
    if (is_bool($value)) {
      return "'" . ($value ? 't' : 'f') . "'";
    }
    if (!is_string($value)) {
      throw new exception('Invalid type');
    }
    return "'" . $this->escape($value) . "'";
  }

}

