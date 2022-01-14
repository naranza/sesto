<?php

/* =============================================================================
 * This file is part of Sesto by Naranza <http://naranza.com>
 *
 * Copyright (c) 2009-2018 Andrea Davanzo <andrea@naranza.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/db/stmt.php';
require_once SESTO_DIR . '/db/driver.php';

final class sesto_mysql_stmt implements sesto_db_stmt
{

  private $driver;
  private $name;
  private $query;
  private $prepared;
  private $error;
  private $types;
  private $values;

  public function __construct($link, string $name)
  {
    $error = sesto_type_check($link, 'pgsql link');
    if ('' !== $error) {
      throw new exception($error, 1000);
    }
    $this->name = $name;
    $this->prepared = false;
    $this->error = '';
    $this->types = [];
    $this->values = [];
  }

  public function prepare(string $name, string $query)
  {
    if ($this->name !== $name) {
      $this->prepared = false;
    }
    $this->name = $name;
    $this->query = $query;
  }

  public function bind(int $index, $value, string $type = null)
  {
    $this->types[$index] = $type;
    $this->values[$index] = $this->driver->quote($value);
  }

  public function execute()
  {
    $this->error = '';
    $query = "";
    $success = false;
    if (!$this->prepared) {
      /* Build the statement */
      $query .= "PREPARE $this->name FROM '$this->query';\n";
      $success = $this->driver->query($query);
      if ($success) {
        $this->prepared = true;
      } else {
        $this->error = $this->driver->error();
      }
    }
    if ($this->prepared) {
      $query = "";
      //EXECUTE stmt2 USING @a, @b;
      $using = [];
      foreach ($this->values as $index => $value) {
        $success = $this->driver->query("SET @a$index = $value;");
        $using[] = "@a$index";
      }
      $query = "EXECUTE $this->name USING " . implode(', ', $using).";";
      $success = $this->driver->query($query);
      if (false === $success) {
        $this->error = $this->driver->error();
      }

    }
    return $success;
  }

  public function deallocate(): bool
  {
    $this->error = '';
    $result = $this->driver->query('DEALLOCATE ' . $this->name);
    return false !== $result;
  }

  public function error(): string
  {
    return $this->error;
  }

}
