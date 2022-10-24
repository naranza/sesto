<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/db/driver.php';
require_once SESTO_DIR . '/db/driver.php';
require_once SESTO_DIR . '/pgsql/connect.php';
require_once SESTO_DIR . '/pgsql/result.php';

class sesto_pgsql_driver implements sesto_db_driver
{

  private $config;
  public bool $connected = false;
  public $conn;
  public string $error = '';
  public static array $prepared;

  private function get_error(): string
  {
    return is_resource($this->conn) ? (string) pg_last_error($this->conn) : '';
  }

  public function __construct(array $config)
  {
    $this->error = '';
    $this->config = $config;
  }

  public function connect(): bool
  {
    if (!$this->connected) {
      $this->error = '';
      $this->conn = sesto_pgsql_connect(
        $this->config['hostname'] ?? '',
        $this->config['username'] ?? '',
        $this->config['password'] ?? '',
        $this->config['database'] ?? '',
        $this->config['options'] ?? [],
        $this->error
      );
      $this->connected = false !== $this->conn;
    }
    return $this->connected;
  }

  public function close(): bool
  {
    self::$prepared = [];
    $this->connected = !pg_close($this->conn);
    return $this->connected;
  }

  public function escape(string $string): string
  {
    $this->connect();
    return pg_escape_string($this->conn, $string);
  }

  public function simulate_error(string $name)
  {
    $this->simulate[$name] = true;
  }

  public function query(string $query, string $name = ''): ?sesto_db_result
  {
    $this->connect();
    if (isset($this->simulate[$name])) {
      $query = 'simulate_error_' . uniqid() . '_[' . $query . ']';
    }
    $result = pg_query($this->conn, $query);
    if (false === $result) {
      $this->error = $this->get_error();
      $result = null;
    } else {
      $result = new sesto_pgsql_result($result);
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
    if (is_object($value) && method_exists($value, '__toString')) {
      return (string) $value;
    }
    if (is_string($value)) {
      return "'" . $this->escape($value) . "'";
    }
    throw new exception('Invalid type');
  }

  public function prepare(string $query, string $stmtname = null): bool
  {
    $this->connect();
    if (!isset(self::$prepared[$stmtname])) {
      self::$prepared[$stmtname] = false !== pg_prepare($this->conn, $stmtname, $query);
      if (!self::$prepared[$stmtname]) {
        $this->error = $this->get_error();
      }
    }
    return self::$prepared[$stmtname];
  }

  public function deallocate(string $stmtname): bool
  {
    $this->connect();
    unset(self::$prepared[$stmtname]);
    return false !== $this->query('deallocate ' . $stmtname);
  }

  public function execute(array $params, string $stmtname): ?sesto_pgsql_result
  {
    $this->connect();
    $result = pg_execute($this->conn, $stmtname, $params);
    if (false === $result) {
      $this->error = $this->get_error();
      $result = null;
    } else {
      $result = new sesto_pgsql_result($result);
    }
    return $result;
  }

  public function query_params(string $query, array $params)
  {
    $this->connect();
    $result = pg_query_params($this->conn, $query, $params);
    if (false === $result) {
      $this->error = $this->get_error();
      $result = null;
    } else {
      $this->error = '';
      $result = new sesto_pgsql_result($result);
    }
    return $result;
  }

}