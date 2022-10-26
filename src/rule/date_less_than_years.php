<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/rule/valid_datetime.php';
require_once SESTO_DIR . '/rule/less_than.php';

function sesto_rule_date_less_than_years(string $date, string $format, int $years, bool $equal = false): bool
{
  $valid = sesto_rule_valid_datetime($date, $format);
  $result = false;
  if ($valid) {
    $dt_now = new datetime('now');
    $dt_value = DateTime::createFromFormat($format, $date);
    $interval = @$dt_value->diff($dt_now);
    if (false !== $interval) {
      if (0 === $interval->invert) {
        $result = sesto_rule_less_than($interval->y, $years, $equal);
      }
    }
  }
  return $result;
}
