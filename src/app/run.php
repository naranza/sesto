<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/app/call.php';
require_once SESTO_DIR . '/app/setup.php';
require_once SESTO_DIR . '/config/read.php';
require_once SESTO_DIR . '/config/parse_php_ini_set.php';
require_once SESTO_DIR . '/config/parse_require.php';
require_once SESTO_DIR . '/config/parse_env.php';
require_once SESTO_DIR . '/config/parse_resource.php';
require_once SESTO_DIR . '/scd/record.php';
require_once SESTO_DIR . '/scd/struct.php';
require_once SESTO_DIR . '/scd/call.php';

require_once SESTO_DIR . '/error/handler.php';

function sesto_app_run(string $sys_dir, callable $callable, array $args = [], string &$error = ''): int
{
  //require
  /* app setup */
  $error = sesto_app_setup($sys_dir);
  if ('' !== $error) {
    throw new exception($error);
  }

  /* load and parse app.php config */
  $config = sesto_config_read($sys_dir . '/conf/config.php');
  if (is_array($config)) {
    /* parse config */
    sesto_config_parse_php_ini_set($config);
    sesto_config_parse_require($config);
    sesto_config_parse_env($config);
    sesto_config_parse_resource($config);

    /* error_strict */
    if ($config['sesto_error_strict'] ?? true) {
      set_error_handler("sesto_error_handler");
    }

    /* error handler */
    if (is_string($config['sesto_app_error_handler'] ?? null)) {
      $error_handler = $config['sesto_app_error_handler'];
      if (!is_callable($error_handler)) {
        $error_handler = null;
      }
    } else {
      $error_handler = null;
    }
  } else {
    $config = [];
  }

  if (null === $error_handler) {
    if ('cli' == php_sapi_name()) {
      require_once SESTO_DIR . '/app/error_handler_cli.php';
      $error_handler = 'sesto_app_error_handler_cli';
    } else {
      require_once SESTO_DIR . '/app/error_handler_web.php';
      $error_handler = 'sesto_app_error_handler_web';
    }
  }
  /* call */
  return sesto_app_call($callable, [$config, $args], $error_handler, $error);
}
