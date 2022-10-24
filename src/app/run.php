<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/app/call.php';
require_once SESTO_DIR . '/config/read.php';
require_once SESTO_DIR . '/app/resource.php';
require_once SESTO_DIR . '/app/env.php';

function sesto_app_run(callable $callable, array $args = [], callable $error_handler = null, string &$error = ''): int
{
  $config = [];
  $exit_code = 1;
  /* initial check */
  if (!defined('SYS_INIT') || false === SYS_INIT) {
    $error = 'Sesto system not initialized';
  } elseif (!defined('APP_INIT') || false === APP_INIT) {
    $error = 'Sesto app not initialized';
  } else {
    /* load and parse app.php config */
    $config = sesto_config_read(APP_CONF_DIR . '/app.php');

    /* app config */
    foreach ($config['require'] ?? [] as $path) {
      require_once $path;
    }

    /* set all the env */
    foreach ($config['env'] ?? [] as $name => $value) {
      sesto_app_env($name, $value);
    }
    if (true === sesto_app_env('error_strict')) {
      require_once SESTO_DIR . '/error/handler.php';
      set_error_handler("sesto_error_handler");
    }
    if (true) {
      require_once SESTO_DIR . '/app/shutdown.php';
      register_shutdown_function("sesto_app_shutdown");
    }

    /* load all the resources */
    foreach ($config['resource'] ?? [] as $name => $value) {
      sesto_app_resource($name, $value);
    }

    /* error handler */
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
    $exit_code = sesto_app_call($callable, [$config, $args], $error_handler, $error);
  }

  return $exit_code;
}
