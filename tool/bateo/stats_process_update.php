<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_stats_process_update(array &$stats, array $testcase_result)
{
  if (count($testcase_result['issues']) > 0) {
    $stats['failed']++;
  } elseif (count($testcase_result['errors']) > 0) {
    $stats['failed']++;
  } else {
    $stats['passed']++;
  }
  $stats['processed']++;
}
