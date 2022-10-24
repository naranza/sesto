<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

require_once 'initme.php';

function sesto_system_init_sys(string $root_dir, string $env, array $dirs = []): string
{
  if (!is_dir($root_dir) || !is_readable($root_dir)) {
    $error = sprintf('%s is not a directory or not readable', $root_dir);
    define('SYS_INIT', false);
  } else {
    define('SYS_STARTED_AT', microtime(true));
    define('SYS_APP_DIR', $root_dir . '/app');
    define('SYS_ENV', $env);
    define('SYS_DIR', $root_dir);
    define('SYS_CONF_DIR', $root_dir . '/conf');
    define('SYS_ETC_DIR', $root_dir . '/etc');
    define('SYS_LIB_DIR', $root_dir . '/lib');
    define('SYS_VAR_DIR', $root_dir . '/var');
    define('SYS_SHARE_DIR', $root_dir . '/share');
    define('SYS_VIEW_DIR', $root_dir . '/view');
    $error = '';
    sesto_bootstrap_initme($dirs, SYS_LIB_DIR);
    define('SYS_INIT', true);
  }
  return $error;
}
