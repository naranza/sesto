<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/is_file_readable.php';

final class sesto_resource
{

  private static $data;

  private function __construct()
  {
    self::$data = [];
  }

  private function __clone()
  {

  }

  private static function init(string $name, string $path)
  {
    if (!sesto_is_file_readable($path)) {
      throw new exception(sprintf("The resource path '%s' is not readable", $name));
    } else {
      self::set($name, include $path);
    }
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
    if (!self::has($name)) {
      throw new exception(sprintf("The resource '%s' does not exists", $name));
    }
    if (is_string(self::$data[$name])) {
      self::init($name, self::$data[$name]);
    }
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

}

