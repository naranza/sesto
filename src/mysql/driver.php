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
require_once SESTO_DIR . '/mysql/result.php';

final class sesto_mysql_driver implements sesto_db_driver
{

  public $link;

  private function get_error(): string
  {
    $error = '';
    if ($this->link instanceof mysqli) {
      $error = mysqli_errno($this->link) . ": " . mysqli_error($this->link);
    }
    return $error;
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
    try {
      $this->link = @mysqli_connect(
        $config['hostname'],
        $config['username'],
        $config['password'],
        $config['database']);
      if ('' !== $encoding) {
        $this->link->set_charset($encoding);
      }
      if ('' !== $timezone) {
        $this->query('SET time_zone = ' . $this->quote($timezone));
      }
    } catch (exception $ex) {
      throw new exception($ex->getmessage());
    }
  }

  public function close(): bool
  {
    $error = sesto_db_check_valid_link($this->link instanceof mysqli);
    if ('' !== $error) {
      throw new exception($error);
    }
    $result = @mysqli_close($this->link);
    if (false === $result) {
      throw new exception($this->get_error());
      $error = $this->get_error();
    }
    return $result;
  }

  public function escape(string $string): string
  {
    $error = sesto_db_check_valid_link($this->link instanceof mysqli);
    if ('' !== $error) {
      throw new exception($error);
    }
    return @mysqli_real_escape_string($this->link, $string);
  }

  public function query(string $query)
  {
    $error = sesto_db_check_valid_link($this->link instanceof mysqli);
    if ('' !== $error) {
      throw new exception($error);
    }
    $result = @mysqli_query($this->link, $query);
    if (false === $result) {
      throw new exception($this->get_error());
    }
    if ($result instanceof mysqli_result) {
      $result = new sesto_mysql_result($result);
    }
    return $result;
  }

  public function quote($value)
  {
    if (is_int($value) || is_float($value)) {
      return $value;
    }
    if (!is_string($value)) {
      throw new exception('Invalid type');
    }
    return "'" . $this->escape($value) . "'";
  }

}

