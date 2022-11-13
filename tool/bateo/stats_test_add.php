<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

function bateo_stats_test_add(array &$stats, array $to_add)
{
  $stats['found'] += $to_add['found'] ?? 0;
  $stats['undefined'] += $to_add['undefined'] ?? 0;
  $stats['skipped'] += $to_add['skipped'] ?? 0;
  $stats['passed'] += $to_add['passed'] ?? 0;
  $stats['failed'] += $to_add['failed'] ?? 0;
  $stats['halted'] += $to_add['halted'] ?? 0;
  $stats['erred'] += $to_add['erred'] ?? 0;
}
