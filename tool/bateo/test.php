<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/test_result.php';

final class bateo_test
{

  private $result;
  public $wie;
  public $wig;

  public function __construct(string $testname)
  {
    $this->result = bateo_test_result($testname);
  }

  private function set_result(int $code, string $message)
  {
    $this->result['code'] = $code;
    if (func_num_args() > 2) {
      $this->result['message'] = call_user_func_array('sprintf', array_slice(func_get_args(), 1));
    } else  {
      $this->result['message'] = $message;
    }
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
    if (null === $message) {
      $message =  bateo_wix($this->wie, $this->wig);
      $args = [$message];
    } else {
      $args = array_slice(func_get_args(), 1);
    }
    if ($condition) {
      $args = array_merge([BATEO_TEST_PASS], $args);
    } else {
      $args = array_merge([BATEO_TEST_FAIL], $args);
    }
    $this->set_result(...$args);
  }

  public function fail_if(bool $condition, string $message = null)
  {
    if (null === $message) {
      $message =  bateo_wix($this->wie, $this->wig);
      $args = [$message];
    } else {
      $args = array_slice(func_get_args(), 1);
    }
    if ($condition) {
      $args = array_merge([BATEO_TEST_FAIL], $args);
    } else {
      $args = array_merge([BATEO_TEST_PASS], $args);
    }
    $this->set_result(...$args);
  }

}
