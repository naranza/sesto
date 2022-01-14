<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/util/load_config.php';

function sesto_form_validate(array $rules, $value, array $context = []): string
{
  $error = '';
  foreach ($rules as $path) {
    $rule = sesto_load_config($path);
    $path = $rule['php_require_once'] ?? '';
    if ('' !== $path) {
      require_once $path;
    }
    $call_function = $rule['function'];
    if (!is_callable($call_function)) {
      throw new exception (sprintf('Function %s is not callable', $call_function));
    }
    $args = $rule['args'] ?? [];
    foreach($args as $key => $arg) {
      if (is_string($arg) && false !== strpos($arg, 'context')) {
        $parts = explode('::', $arg);
        if (isset($parts[1])) {
          $args[$key] = $context[$parts[1]] ?? null;
        }
      }
    }
    $is_valid = $call_function($value, ...$args);
    if (!$is_valid) {
      $error = $rule['message'] ?? 'Invalid value';
      break;
    }
  }
  return $error;
}

