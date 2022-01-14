<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_rule_valid_datetime(string $value, string $format): bool
{
  $result = datetime::createfromformat($format, $value);
  if (false !== $result) {
    $errors = datetime::getlasterrors();
    if (0 === $errors['warning_count'] && 0 === $errors['error_count']) {
      $result = true;
    } else {
      $result = false;
    }
  }
  return $result;
}

