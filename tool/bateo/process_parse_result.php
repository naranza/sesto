<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_stats_update(array $stats, int $code): array
{
  $return = $stats;
  switch ($code) {
    case BATEO_TEST_UNDEFINED:
      $return['undefined']++;
      break;
    case BATEO_TEST_PASS:
      $return['passed']++;
      break;
    case BATEO_TEST_FAIL:
      $return['failed']++;
      break;
    case BATEO_TEST_ERROR:
      $return['erred']++;
      break;
    case BATEO_TEST_HALT:
      $return['halted']++;
      break;
    case BATEO_TEST_SKIP:
      $return['skipped']++;
      break;
  }
  return $return;
}
