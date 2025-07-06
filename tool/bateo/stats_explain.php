<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_process_stats_explain(array $stats, string $bootstrap_error, int $shutdown_errors): array
{
  $code = 1;
  $result = 'FAILED';
  $reason = 'Unknown';
  if ('' === $bootstrap_error && 0 == $shutdown_errors) {
    if (0 === $stats['process_stats']['failed']) {
      if (0 !== $stats['process_stats']['found']) {
        if (0 !== $stats['test_stats']['found']) {
          $code = 0;
          $result = 'PASSED';
          $reason = 'No errors or issues found';
        } else {
          $reason = 'No tests found';
        }
      } else {
        $reason = 'No test cases found';
      }
    } else {
      $reason = 'Failed test cases found';
    }
  } elseif ('' !== $bootstrap_error) {
    $reason = 'Bootstrap error found';
  } elseif (0 !== $shutdown_errors) {
    $reason = 'Shutdown errors found';
  }
  return [$code, $result, $reason];
}
