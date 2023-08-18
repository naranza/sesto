<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types=1);

include __DIR__ . '/initme.php';
include BATEO_DIR . '/display_errors.php';
include BATEO_DIR . '/error_handler.php';
include BATEO_DIR . '/last_error.php';
include BATEO_DIR . '/load_config.php';
include BATEO_DIR . '/is_readable.php';
include BATEO_DIR . '/get_commands.php';
include BATEO_DIR . '/find_testcases.php';
include BATEO_DIR . '/testcase_run.php';
include BATEO_DIR . '/ipchandler_file.php';
include BATEO_DIR . '/process_testcases.php';
include BATEO_DIR . '/process_stats_print.php';
include BATEO_DIR . '/stats_explain.php';
include BATEO_DIR . '/shutdown_parse.php';
include BATEO_DIR . '/wix.php';
include BATEO_DIR . '/print_th.php';
include BATEO_DIR . '/dump.php';

try {
  /* parent */
  list($commands, $bootstrap_error) = bateo_get_commands($argv);
  $shutdown_path = sys_get_temp_dir() . '/bateo-shutdown.list';
  $started = microtime(true);
  $process_stats = [];
  if ('' === $bootstrap_error) {
    bateo_display_errors($commands['error_reporting']);
    set_error_handler('bateo_error_handler');
    $config = bateo_load_config($commands['config_path']);

    if (file_exists($shutdown_path)) {
      unlink($shutdown_path);
    }
    $datalist = bateo_find_testcases($commands['test_path']);
    $ipc_handler = new bateo_ipchandler_file();
    /* boostrap file */
    if ('' !== $commands['bootstrap_path']) {
      if (bateo_is_readable($commands['bootstrap_path'])) {
        require $commands['bootstrap_path'];
      } else {
        throw new exception(sprintf('%s is not readable', $commands['bootstrap_path']));
      }
    }
    /* handle shutdown */
    if ($commands['handle_shutdown']) {
      register_shutdown_function('bateo_last_error', $shutdown_path);
    }
    /* process testcases */
    $process_stats = bateo_process_testcases($datalist, $ipc_handler);
    $bootstrap_error = '';
  }
} catch (throwable $exception) {
  $bootstrap_error = sprintf("Bootstrap error: %s\n", bateo_print_th($exception, true));
}
echo "\n";
$shutdown_errors = 0;
if ($commands['handle_shutdown']) {
  if (file_exists($shutdown_path) && is_readable($shutdown_path)) {
    $shutdown_errors = (int) exec('wc -l < ' . $shutdown_path);
  }
}
/* Process summary */
if (!empty($process_stats)) {
  bateo_process_stats_print($process_stats);
}
if ('' !== $bootstrap_error) {
  echo "\n\n";
  echo "== Boostrap error\n";
  echo sprintf("%s\n", $bootstrap_error);
}
list($code, $result, $reason) = bateo_process_stats_explain($process_stats, $bootstrap_error, $shutdown_errors);
/* parse shutdown */
bateo_shutdown_parse($shutdown_path, $shutdown_errors);
echo "\n\n";
echo "== Final result\n\n";
echo sprintf("Process result: %s\n", $result);
echo sprintf("Reason: %s\n", $reason);
echo "\n----\n";
echo sprintf("Tested with Naranza Bateo - Release %s - by %s\n", BATEO_VERSION, 'Andrea Davanzo');
echo sprintf("Process completed in %01.5f secs\n", microtime(true) - $started);
echo "\n";
exit($code);
