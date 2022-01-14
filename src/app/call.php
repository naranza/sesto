<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/exit.php';

function sesto_app_call(callable $callable, array $args = [], callable $error_handler = null): int
{
  $exit_code = 0;
  try {
    $callable(...$args);
    $exit_code = 0;
  } catch (sesto_exit $throwable) {
    $exit_code = 0;
  } catch (throwable $throwable) {
    /* check if output buffer is started */
    if (ob_get_length() > 0) {
      @ob_clean();
      @ob_end_clean();
    }
    if (null !== $error_handler) {
      call_user_func_array($error_handler, [$throwable, $args]);
    }
    $exit_code = 1;
  }
  return $exit_code;
}

