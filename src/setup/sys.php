<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.com
 * ========================================================================== */

declare(strict_types=1);

function sesto_setup_sys(string $dir, string $name, array $dirs = []): string
{
  define('SYS_NAME', strtolower($name));
  if (!is_dir($dir) || !is_readable($dir)) {
    $error = sprintf('%s is not a directory or not readable', $dir);
    define('SYS_INIT', false);
  } else {
    define('SYS_STARTED_AT', microtime(true));
    define('SYS_DIR', $dir);
    define('SYS_APP_DIR', $dir . '/app');
    define('SYS_BIN_DIR', $dir . '/bin');
    define('SYS_CONF_DIR', $dir . '/conf');
    define('SYS_ETC_DIR', $dir . '/etc');
    define('SYS_LIB_DIR', $dir . '/lib');
    define('SYS_VAR_DIR', $dir . '/var');
    define('SYS_SHARE_DIR', $dir . '/share');
    define('SYS_WWW_DIR', $dir . '/www');
    $error = '';
    foreach ($dirs as $dir) {
      $path = $dir . '/initme.php';
      if (false === strpos($dir, '/')) {
        $path = 'APP_LIB_DIR' . '/' . $path;
      }
      if (is_file($path) && is_readable($path)) {
        require $path;
      }
    }
    define('SYS_INIT', true);
  }
  return $error;
}
