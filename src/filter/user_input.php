<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/string/trim.php';

function sesto_filter_user_input(array $values): array
{
  $input = [];
  foreach ($values as $name => $value) {
    if (is_array($value)) {
      $value = sesto_filter_user_input($value);
    } else {
      $value = trim(sesto_string_trim($value));
    }
    $input[$name] = $value;
  }
  return $input;
}
