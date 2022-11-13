<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/code_to_string.php';

function bateo_testcase_summary_print(array $testcase_result)
{
  $num_issues = count($testcase_result['issues']);
  $num_errors = count($testcase_result['errors']);
  if (empty($num_issues) && empty($num_errors)) {
    return;
  }
  echo "== Testcase summary\n";
  echo "Testcase: {$testcase_result['path']}\n";
  if (0 == $num_issues) {
    // echo "No issues found\n";
  } else {
    echo sprintf("Issues found: %d\n", $num_issues);
    foreach ($testcase_result['issues'] as $key) {
      echo sprintf(
        "%s | %s | %s\n",
        ($testcase_result['results'][$key]['testname'] ?? ''),
        (bateo_code_to_string($testcase_result['results'][$key]['code']) ?? ''),
        ($testcase_result['results'][$key]['message'] ?? ''));
    }
    echo "\n";
  }
  if (0 == $num_errors) {
    //  echo "No errors found\n";
  } else {
    echo sprintf("Errors found: %d\n", $num_errors);
    foreach ($testcase_result['errors'] as $string) {
      echo "$string\n";
    }
  }
  echo "\n";
}
