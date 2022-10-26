<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

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
