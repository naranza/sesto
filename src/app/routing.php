<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

//require_once SESTO_DIR . '/app/call.php';
//require_once SESTO_DIR . '/util/config.php';
//require_once SESTO_DIR . '/util/display_errors.php';
//require_once SESTO_DIR . '/util/error_handler.php';
//require_once SESTO_DIR . '/scd/load.php';
//require_once SESTO_DIR . '/dev/last_error.php';
//require_once SESTO_DIR . '/dev/dump_session.php';
//require_once SESTO_DIR . '/dev/var_dump.php';
//require_once SESTO_DIR . '/dev/dump_app_error.php';

function sesto_app_routing(array $config = null, string &$error = ''): int
{
  list($router_func, $router_args) = sesto_scd_load($config['router'] ?? []);
  list($dispatcher_func, $dispatcher_args) = sesto_scd_load($config['app_dispatcher'] ?? []);
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
  $app['route'] = call_user_func_array($router_func, array_merge([$config], $router_args));
  /* dispatching */
  $func_call = $dispatcher_func;
//  }
  $func_args = array_merge($args, [$app], $dispatcher_args);
  return sesto_app_call($func_call, $func_args, $error_handler, $error);
}
