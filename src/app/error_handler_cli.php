<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_app_error_handler_cli(throwable $throwable, array $args = []): void
{
  $status_codes = [
    200 => 'OK',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    410 => 'Gone',
    500 => 'Internal Server Error',
    503 => 'Service Unavailable'
  ];
  $code = isset($status_codes[$throwable->getcode()]) ? $throwable->getcode() : 500;
  $message = $status_codes[$code];
  if ('dev' === SYS_ENV) {
    $debug = $throwable->getmessage();
  } else {
    $debug = '';
  }
  echo "\n--- Exception ---\n";
  echo sprintf("%s: %s\n", $code, $message);
  if ('' !== $debug) {
    echo sprintf("Debug: %s\n\n", $debug);
    echo sprintf("\tThrowable: %s\n", print_r($throwable, true));
    echo sprintf("\targs: %s\n", print_r($args, true));
  }
}
