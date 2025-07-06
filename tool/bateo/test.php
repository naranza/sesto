<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once BATEO_DIR . '/test_result.php';

final class bateo_test
{

  private $result;
  public mixed $wie = null;
  public mixed $wig = null;

  public function __construct(string $testname)
  {
    $this->result = bateo_test_result($testname);
  }

  private function set_result(int $code, string $message)
  {
    $this->result['code'] = $code;
    if (func_num_args() > 2) {
      $this->result['message'] = call_user_func_array('sprintf', array_slice(func_get_args(), 1));
    } else {
      $this->result['message'] = $message;
    }
  }

  private function set_args(string|null $message, array $func_args)
  {
    if (null === $message) {
      if ($this->wie !== null && $this->wig !== null) {
        $args = [bateo_wix($this->wie, $this->wig)];
      } else {
        $args = [''];
      }
    } else {
      $args = array_slice($func_args, 1);
    }
    return $args;
  }

  public function result(): array
  {
    return $this->result;
  }

  public function halt(string $message)
  {
    $this->set_result(BATEO_TEST_HALT, ...func_get_args());
  }

  public function skip(string $message)
  {
    $this->set_result(BATEO_TEST_SKIP, ...func_get_args());
  }

  public function error(string $message)
  {
    $this->set_result(BATEO_TEST_ERROR, ...func_get_args());
  }

  public function pass(string $message)
  {
    $this->set_result(BATEO_TEST_PASS, ...func_get_args());
  }

  public function fail(string $message)
  {
    $this->set_result(BATEO_TEST_FAIL, ...func_get_args());
  }

  public function pass_if(bool $condition, string $message = null)
  {
    if ($condition) {
      $args = array_merge([BATEO_TEST_PASS], $this->set_args($message, func_get_args()));
    } else {
      $args = array_merge([BATEO_TEST_FAIL], $this->set_args($message, func_get_args()));
    }
    $this->set_result(...$args);
  }

  public function fail_if(bool $condition, string $message = null)
  {
    if ($condition) {
      $args = array_merge([BATEO_TEST_FAIL], $this->set_args($message, func_get_args()));
    } else {
      $args = array_merge([BATEO_TEST_PASS], $this->set_args($message, func_get_args()));
    }
    $this->set_result(...$args);
  }
}
