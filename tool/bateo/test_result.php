<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

function bateo_test_result(string $testname)
{
  return [
    'testname' => $testname,
    'code' => BATEO_TEST_UNDEFINED,
    'message' => '',
    'halted' => false];
}
