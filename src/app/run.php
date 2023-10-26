<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/app/define.php';
require_once SESTO_DIR . '/util/config.php';
require_once SESTO_DIR . '/util/ini_set_array.php';
require_once SESTO_DIR . '/util/require_array.php';
require_once SESTO_DIR . '/util/exit.php';
require_once SESTO_DIR . '/util/registry.php';
require_once SESTO_DIR . '/util/resource.php';
//require_once SESTO_DIR . '/scd/record.php';
//require_once SESTO_DIR . '/scd/struct.php';
//require_once SESTO_DIR . '/scd/call.php';
require_once SESTO_DIR . '/util/error_handler.php';

function sesto_app_run(string $sys_dir, callable $callback, array $args = [], string &$error = ''): int
{

  $exit_code = 0;
  $error = '';
  $error_handler = null;
  try {
    $define_error = sesto_app_define($sys_dir);
    if ('' !== $define_error) {
      throw new exception($define_error);
    }

    /* load and parse app.php config */
    $config = sesto_config_read($sys_dir . '/conf/config.php');
    if (is_array($config)) {
      /* parse ini_set */
      sesto_ini_set_array($config['sesto_php_ini_set'] ?? []);

      /* parse require */
      sesto_require_array($config['sesto_require'] ?? []);

      /* parse env */
      foreach ($config['env'] ?? [] as $name => $value) {
        sesto_registry($name, $value);
      }

      /* parse resource */
      foreach ($config['resource'] ?? [] as $name => $value) {
        sesto_resource($name, $value);
      }

      /* error_strict */
      if ($config['sesto_error_strict'] ?? true) {
        set_error_handler("sesto_error_handler");
      }
      if (!isset($config['sesto_app_error_handler'])) {
        $error_handler = null;
      } else {
        $error_handler = $config['sesto_app_error_handler'];
      }

      if (null !== $error_handler && !is_callable($error_handler)) {
        throw new exception('Error handler not callale');
      }
    } else {
      $config = [];
    }

    if (null === $error_handler) {
      if ('cli' == php_sapi_name()) {
        require_once SESTO_DIR . '/app/error_cli.php';
        $error_handler = 'sesto_app_error_cli';
      } else {
        require_once SESTO_DIR . '/app/error_web.php';
        $error_handler = 'sesto_app_error_web';
      }
    }
    $callback($config, $args);
  } catch (sesto_exit $throwable) {
    /* do nothing */
  } catch (throwable $throwable) {
    /* check if output buffer is started */
    if (ob_get_length() > 0) {
      ob_clean();
      ob_end_clean();
    }
    if (null !== $error_handler) {
      call_user_func_array($error_handler, [$throwable, $args]);
    }
    $exit_code = 1;
    $error = $throwable->getmessage();
  }
  return $exit_code;
}
