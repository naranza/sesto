<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

final class sesto_registry
{

  private static $instance = null;
  public $data;

  public static function getme(): sesto_registry
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    $this->data = [];
  }

  private function __clone()
  {

  }

  final public function __set($name, $value)
  {
    throw new exception($name . ' property not defined');
  }

  final public function __get($name)
  {
    throw new exception($name . ' property not defined');
  }

}
