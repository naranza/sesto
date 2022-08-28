<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.com
 * ========================================================================== */

declare(strict_types=1);

function sesto_setup_app(string $dir, string $name, array $dirs = []): string
{
  define('APP_NAME', strtolower($name));
  $app_dir = $dir;
  if ('' !== $name) {
    $app_dir .= '/' . $name;
  }
  if (!is_dir($app_dir) || !is_readable($app_dir)) {
    define('APP_INIT', false);
    $error = sprintf('%s is not a directory or not readable', $app_dir);
  } else {
    define('APP_DIR', $app_dir);
    define('APP_BIN_DIR', $app_dir . '/bin');
    define('APP_CONF_DIR', $app_dir . '/conf');
    define('APP_ETC_DIR', $app_dir . '/etc');
    define('APP_LIB_DIR', $app_dir . '/lib');
    define('APP_VAR_DIR', $app_dir . '/var');
    define('APP_SHARE_DIR', $app_dir . '/share');
    define('APP_WWW_DIR', $app_dir . '/www');
    define('APP_INIT', true);
    foreach ($dirs as $dir) {
      $path = $dir . '/initme.php';
      if (false === strpos($dir, '/')) {
        $path = 'APP_LIB_DIR' . '/' . $path;
      }
      if (is_file($path) && is_readable($path)) {
        require $path;
      }
    }
    $error = '';
  }
  return $error;
}
