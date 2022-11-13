<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/testcase_init.php';
require_once BATEO_DIR . '/test.php';
require_once BATEO_DIR . '/testcase_get_issues.php';
require_once BATEO_DIR . '/stats_test.php';
require_once BATEO_DIR . '/stats_test_update.php';

function bateo_testcase_run(string $path): array
{
  $result = [
    'path' => $path,
    'test_stats' => bateo_stats_test(),
    'issues' => [],
    'errors' => [],
    'halted' => false,
    'results' => []];

  /* init testcase */
  try {
    $testcase = bateo_testcase_init($path);
  } catch (throwable $throwable) {
    $result['errors']['init'] = $throwable->getmessage();
    $testcase = null;
  }

  if ($testcase instanceof bateo_testcase_interface) {
    /* testcase setup */
    if (count($result['errors']) == 0) {
      $tests = preg_grep('/^t_/', get_class_methods($testcase));
      $result['test_stats']['found'] = count($tests);
      try {
        $testcase->setup();
      } catch (throwable $throwable) {
        $result['errors']['setup'] = $throwable->getmessage();
      }
    }

    /* call testcase tests */
    if (count($result['errors']) == 0) {
      foreach ($tests as $testname) {
        $test = new bateo_test($testname);
        if (!$result['halted']) {
          $skipped_by = '';
          try {
            $testcase->{$testname}($test);
            $test_result = $test->result();
          } catch (throwable $throwable) {
            if (!$test->wie instanceof throwable) {
              $test->error(bateo_print_th($throwable, true));
            } else {
              $test->pass('throwable expected');
            }
            $test_result = $test->result();
          }
          if (BATEO_TEST_HALT === $test_result['code']) {
            $result['halted'] = true;
            $skipped_by = $testname;
          }
        } else {
          $test->skip(sprintf('Skipped by halted test %s', $skipped_by));
          $test_result = $test->result();
        }
        $result['results'][] = $test_result;
        bateo_stats_test_update($result['test_stats'], $test_result);
      }
    }

    /* call testcase teardown() */
    try {
      $testcase->teardown();
    } catch (throwable $throwable) {
      $result['errors']['teardown'] = $throwable->getmessage();
    }
  }
  $result['issues'] = bateo_testcase_get_issues($result);
  return $result;
}
