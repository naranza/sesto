<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_process_stats_print(array $stats): void
{
  echo "== Process summary\n";
  if (empty($stats)) {
    echo "Nothing to show";
    echo "\n";
  } else {
    echo sprintf("- Test cases found: %d \n", ($stats['process_stats']['found'] ?? ''));
    echo sprintf("- Test cases passed: %d\n", ($stats['process_stats']['passed'] ?? ''));
    echo sprintf("- Test cases failed: %d\n", ($stats['process_stats']['failed'] ?? ''));
    echo "\n";
    echo sprintf("- Tests found: %d \n", $stats['test_stats']['found']);
    echo sprintf("- Tests undefined: %d\n", $stats['test_stats']['undefined']);
    echo sprintf("- Tests passed: %d\n", $stats['test_stats']['passed']);
    echo sprintf("- Tests failed: %d\n", $stats['test_stats']['failed']);
    echo sprintf("- Tests erred: %d\n", $stats['test_stats']['erred']);
    echo sprintf("- Tests halted: %d\n", $stats['test_stats']['halted']);
    echo sprintf("- Tests skipped: %d\n", $stats['test_stats']['skipped']);
  }
}
