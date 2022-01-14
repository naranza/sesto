<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

class sesto_view_engine
{

  private $data = [];

  private $views = [];

  private $helpers = [];

  public function __set(string $name, $value)
  {
    $this->data[$name] = $value;
  }

  public function __get(string $name)
  {
    if (!isset($this->data[$name])) {
      throw new exception(sprintf("The data '%s' data does not exists", $name));
    } else {
      return $this->data[$name];
    }
  }

  public function __isset(string $name): bool
  {
    return array_key_exists($name, $this->data);
  }

  public function __unset(string $name)
  {
    unset($this->data[$name]);
  }

  public function set_helper(string $name, $callable)
  {
    $this->helpers[$name] = $callable;
  }

  public function has_helper(string $name): bool
  {
    return isset($this->helpers[$name]);
  }

  public function __call(string $name, $args)
  {
    if (!isset($this->helpers[$name])) {
      throw new exception(sprintf("Unable to call '%s'", $name), 101);
    }
    return call_user_func_array($this->helpers[$name], $args);
  }

  public function set_view(string $name, string $path)
  {
    $this->views[$name] = $path;
  }

  public function has_view($name): bool
  {
    return isset($this->views[$name]);
  }

  public function get_view(string $name): string
  {
    if (!$this->has_view($name)) {
      throw new exception(sprintf("The view '%s' does not exists", $name));
    }
    return $this->views[$name];
  }

  public function render(string $name, bool $strict = true)
  {
    $has_view = $this->has_view($name);
    if (!$has_view && $strict) {
      throw new exception(sprintf("The view '%s' does not exists", $name));
    } elseif ($has_view) {
      $readable = is_file($this->views[$name]) && is_readable($this->views[$name]);
      if (!$readable && $strict) {
        throw new exception(sprintf("The view '%s' (%s) is not readable", $name, $this->views[$name]));
      } elseif ($readable) {
        include $this->views[$name];
      }
    }
  }

}
