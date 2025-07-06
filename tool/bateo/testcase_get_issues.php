<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_testcase_get_issues(array $test_result): array
{
  $issues = [];
  foreach ($test_result['results'] as $key => $result) {
    if (BATEO_TEST_PASS !== $result['code']) {
      $issues[] = $key;
    }
  }
  return $issues;
}
