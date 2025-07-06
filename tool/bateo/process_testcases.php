<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once BATEO_DIR . '/stats_process.php';
require_once BATEO_DIR . '/stats_process_update.php';
require_once BATEO_DIR . '/stats_test.php';
require_once BATEO_DIR . '/stats_test_add.php';
require_once BATEO_DIR . '/testcase_summary_print.php';

function bateo_process_testcases(bateo_datalist_interface $datalist, bateo_ipchandler_interface $ipc_handler): array
{
  $result = [
    'process_stats' => bateo_stats_process(),
    'test_stats' => bateo_stats_test()
  ];
  $pids = [];
  $id = 0;
  $datalist->open();
  $result['process_stats']['found'] = $datalist->num_written();
  /* parse the list */
  while ($testcase = $datalist->read()) {
    if (count($pids) > 10) {
      /* waiting for a child exit */
      $pid = pcntl_waitpid(-1, $status);
      $testcase_result = bateo_read_ipc($ipc_handler, $pid);
      if (!empty($testcase_result)) {
        bateo_stats_test_add($result['test_stats'], $testcase_result['test_stats']);
        bateo_stats_process_update($result['process_stats'], $testcase_result);
        bateo_testcase_summary_print($testcase_result);
      }
      /* remove completed task by pid */
      unset($pids[$pid]);
    }
    $id++;
    /* process */
    $pid = pcntl_fork();
    if ($pid == -1) {
      throw new exception('Could not fork');
    } else if ($pid) {
      /* parent */
      $pids[$pid] = ['testcase' => $testcase];
    } else {
      /* child */
      $child_pid = getmypid();
      try {
        $testcase_result = bateo_testcase_run($testcase);
      } catch (throwable $throwable) {
        $testcase_result = [];
      }
      /* child process completed */
      $ipc_handler->save($child_pid, json_encode($testcase_result, JSON_INVALID_UTF8_SUBSTITUTE));
      exit(0);
    }
  }

  while (count($pids) > 0) {
    foreach (array_keys($pids) as $pid) {
      $res = pcntl_waitpid($pid, $status, WNOHANG);
      /* If the process has already exited */
      if ($res == -1 || $res > 0) {
        /* parse ipcmsg */
        $testcase_result = bateo_read_ipc($ipc_handler, $pid);
        if (!empty($testcase_result)) {
          bateo_stats_test_add($result['test_stats'], $testcase_result['test_stats']);
          bateo_stats_process_update($result['process_stats'], $testcase_result);
          bateo_testcase_summary_print($testcase_result);
        }
        /* remove child  pid that has been freed */
        unset($pids[$pid]);
      }
    }
  }
  return $result;
}

function bateo_read_ipc(bateo_ipchandler_interface $ipc_handler, int $pid): array
{
  try {
    $testcase_result = json_decode($ipc_handler->load($pid), true);
    $ipc_handler->delete($pid);
  } catch (throwable $trowable) {
    /* a fatal error occurred */
    $testcase_result = [];
  }
  return $testcase_result;
}
