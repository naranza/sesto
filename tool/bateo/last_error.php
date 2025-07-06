<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_last_error(string $path)
{
  /**
   * The following error types cannot be handled with a user defined function:
   * E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR,
   * E_COMPILE_WARNING independent of where they were raised, and most of
   * E_STRICT raised in the file where set_error_handler() is called.
   *
   * https://www.php.net/manual/en/function.set-error-handler.php
   */
  $shutdown_errors = [E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_STRICT];
  $e = error_get_last();
  if (null !== $e && in_array($e['type'], $shutdown_errors)) {
    $data = [
      'type' => $e['type'] ?? '',
      'message' => $e['message'] ?? '',
      'file' => $e['file'] ?? '',
      'line' => $e['line'] ?? '',
    ];
    $message = $e['message'] ?? '';
    if (false !== $pos = strpos($data['message'] ?? '', 'Stack trace:')) {
      $message = trim(substr($data['message'], 0, $pos));
      $stack_trace = substr($data['message'], $pos);
      $data['message'] = $message;
      $data['stack_trace'] = explode("\n", str_replace("Stack trace:\n", '', $stack_trace));
    }
    file_put_contents(
      $path,
      (string) json_encode(['datetime' => gmdate('Y-m-d H:i:s e'), 'error' => $data]) . "\n",
      FILE_APPEND
    );
  }
}
