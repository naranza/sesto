<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/app/call.php';
require_once SESTO_DIR . '/util/config.php';
require_once SESTO_DIR . '/util/display_errors.php';
require_once SESTO_DIR . '/util/error_handler.php';
require_once SESTO_DIR . '/scd/load.php';
require_once SESTO_DIR . '/dev/last_error.php';
require_once SESTO_DIR . '/dev/dump_session.php';
require_once SESTO_DIR . '/dev/var_dump.php';
require_once SESTO_DIR . '/dev/dump_app_error.php';

final class sesto_system_app
{

  public $error = '';
  public $config;
  public $error_handler;

  public function config(array $config)
  {
    $this->config = $config;
  }

  public function error_handler(callable $error_handler = null)
  {
    $this->error_handler = $error_handler;
  }

  public function run(array $args = []): int
  {
    $this->error = '';
    $exit_code = 1;
    $app = [
      'config' => [],
      'route' => []
    ];
    /* initial check */
    if (!defined('SYS_INIT') || false === SYS_INIT) {
      $this->error = 'Sesto system not initialized';
      return $exit_code;
    }
    if (!defined('APP_INIT') || false === APP_INIT) {
      $this->error = 'Sesto app not initialized';
      return $exit_code;
    }
    /* set display errors */
    if ('dev' === SYS_ENV) {
      register_shutdown_function('sesto_last_error');
      sesto_display_errors(true);
    } else {
      sesto_display_errors(false);
    }
    /* app config */
    if (null === $this->config) {
      $this->config = sesto_config(APP_CONF_DIR . '/app', false, SYS_ENV);
    }
    $app['procedure'] = $this->config;
    foreach ($this->config['require'] ?? [] as $path) {
      require_once $path;
    }
    /* error handler */
    if (true) {
      require_once SESTO_DIR . '/system/error_handler_web.php';
      $this->error_handler = 'sesto_system_error_handler_web';
      set_error_handler('sesto_error_handler');
    }

    /* execution */
    $func_call = null;
    $callable = $this->config['app_callable'] ?? '';
    if (is_callable($callable)) {
      $func_call = $callable;
      $dispatcher_args = [];
    } else {
      $sesto_router = $this->config['router'] ?? [];
      $sesto_dispatcher = $this->config['app_dispatcher'] ?? [];
      list($router_func, $router_args) = sesto_scd_load($sesto_router);
      list($dispatcher_func, $dispatcher_args) = sesto_scd_load($sesto_dispatcher);

      if ('' === $router_func) {
        $error = sprintf('Router function not defined');
      } elseif (!is_callable($router_func)) {
        $error = sprintf("Router function '%s' not callable", $router_func);
      } elseif ('' === $dispatcher_func) {
        $error = 'Dispatcher function not defined';
      } elseif (!is_callable($dispatcher_func)) {
        $error = sprintf("Dispatcher function '%s' not callable", $dispatcher_func);
      } else {
        $error = '';
      }
      if ('' !== $error) {
        throw new exception($error, 500);
      }
      /* routing */
      $app['route'] = call_user_func_array($router_func, array_merge([$this->config], $router_args));
      /* dispatching */
      $func_call = $dispatcher_func;
    }
    $func_args = array_merge($args, [$app], $dispatcher_args);
    return sesto_app_call($func_call, $func_args, $this->error_handler);
  }

}