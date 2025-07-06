<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_stats_test_update(array &$stats, array $test_result)
{
  switch ($test_result['code']) {
    case BATEO_TEST_PASS:
      $stats['passed']++;
      break;
    case BATEO_TEST_FAIL:
      $stats['failed']++;
      break;
    case BATEO_TEST_UNDEFINED:
      $stats['undefined']++;
      break;
    case BATEO_TEST_ERROR:
      $stats['erred']++;
      break;
    case BATEO_TEST_HALT:
      $stats['halted']++;
      break;
    case BATEO_TEST_SKIP:
      $stats['skipped']++;
      break;
  }
}
