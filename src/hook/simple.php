<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

final class sesto_hook_simple
{

  protected array $hooks;
  protected static $instance;

  public static function getme(): sesto_hook_simple
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    $this->hooks = [];
  }

  private function __clone()
  {

  }

  public function get(string $name = null): false|array
  {
    return ($name === null) ? $this->hooks : ($this->hooks[$name] ?? []);
  }

  public function attach(string $name, callable $callback, int $priority = 50): void
  {
    $this->hooks[$name][$priority][] = $callback;
  }

  public function filter(string $name, $value): mixed
  {
    $filtered = $value;
    $calls = $this->hooks[$name] ?? [];
    if (!empty($calls)) {
      ksort($calls, SORT_NUMERIC);
      $args = [];
      if (func_num_args() > 3) {
        $args = array_slice(func_get_args(), 2);
      }
      foreach ($calls as $block) {
        foreach ($block as $callback) {
          $filtered = $callback($filtered, ...$args);
        }
      }
    }
    return $filtered;
  }

  public function function(string $name, ...$args): mixed
  {
    $result = null;
    $calls = $this->hooks[$name] ?? [];
    ksort($calls, SORT_NUMERIC);
    foreach ($calls as $block) {
      foreach ($block as $callback) {
        $result = $callback(...$args);
      }
    }
//    sesto_d(sprintf("%s -> %s", $name, ($callback ?? 'null')), __FUNCTION__);
    return $result;
  }

  public function procedure(string $name, &...$args): void
  {
    $calls = $this->hooks[$name] ?? [];
    if (!empty($calls)) {
      ksort($calls, SORT_NUMERIC);
      foreach ($calls as $block) {
        foreach ($block as $callback) {
          $callback(...$args);
        }
      }
    }
//    sesto_d(sprintf("%s -> %s", $name, ($callback ?? 'null')), __FUNCTION__);
  }
}
