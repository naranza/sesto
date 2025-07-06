<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_code_to_string($code): string
{
  switch ($code) {
    case BATEO_TEST_PASS: return 'PASS';
    case BATEO_TEST_FAIL: return 'FAIL';
    case BATEO_TEST_UNDEFINED: return 'UNDEFINED';
    case BATEO_TEST_ERROR: return 'ERROR';
    case BATEO_TEST_HALT: return 'HALT';
    case BATEO_TEST_SKIP: return 'SKIP';
    default: return '';
  }
}
