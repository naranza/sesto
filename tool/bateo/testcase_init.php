<?php

/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types=1);

function bateo_testcase_init(string $path): object
{
  if (!is_file($path) && !is_readable($path)) {
    throw new exception(sprintf('The testcase path %s is not readable', $path));
  }

  @include($path);

  if (isset($class)) {
    $testcase = new $class();
  } else {
    if (!class_exists('bateo_testcase')) {
      throw new exception(sprintf('bateo_testcase or $class not found on %s', $path));
    }
    $testcase = new bateo_testcase();
  }
  return $testcase;
}
