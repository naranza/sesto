<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_test_result(string $testname)
{
  return [
    'testname' => $testname,
    'code' => BATEO_TEST_UNDEFINED,
    'message' => '',
    'halted' => false];
}
