<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

final class sesto_store
{

  private static $data;

  private function __construct()
  {
    self::$data = [];
  }

  private function __clone()
  {

  }

  public static function set(string $name, $value)
  {
    self::$data[$name] = $value;
  }

  public static function data(): array
  {
    return self::$data;
  }

  public static function get(string $name)
  {
    return self::$data[$name];
  }

  public static function del(string $name)
  {
    unset(self::$data[$name]);
  }

  public static function has(string $name): bool
  {
    return isset(self::$data[$name]);
  }

  public static function exists(string $name): bool
  {
    return array_key_exsits($name, self::$data);
  }

}

