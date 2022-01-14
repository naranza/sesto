<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/exit.php';
require_once SESTO_DIR . '/util/display_errors.php';
require_once SESTO_DIR . '/util/error_handler.php';
require_once SESTO_DIR . '/util/is_file_readable.php';

function sesto_app_run(array $app_args, int &$exit_code = null): ?throwable
{
  try {
    sesto_display_errors('' != ($app_args['env'] ?? ''));
    set_error_handler('sesto_error_handler');
    if (!isset($app_args['program'])) {
      throw new exception('program not defined');
    }
    if (!sesto_is_file_readable($app_args['program'])) {
      throw new exception(sprintf('%s path is not readable', $app_args['program']));
    }
    require $app_args['program'];
    $exit_code = 0;
    $return = null;
  } catch (sesto_exit $throwable) {
    $exit_code = 0;
    $return = $throwable;
  } catch (throwable $throwable) {
    $exit_code = 1;
    $return = $throwable;
  }
  return $return;
}

