<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/testcase_interface.php';

function bateo_testcase_init(string $path): bateo_testcase_interface
{
  if (!is_file($path) && !is_readable($path)) {
    throw new exception(sprintf('The testcase path %s is not readable', $path));
  }

  @include($path);

  if (isset($class)) {
    $testcase = new $class();
  } else {
    if (!class_exists('bateo_testcase')) {
      throw new exception(sprintf('$class not defined on %s', $path));
    }
    $testcase = new bateo_testcase();
  }
  return $testcase;
}
