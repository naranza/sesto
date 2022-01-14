<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/rule/valid_datetime.php';
require_once SESTO_DIR . '/rule/greater_than.php';

function sesto_rule_date_greater_than_years(string $date, string $format, int $years, bool $equal = false): bool
{
  $result = false;
  if (sesto_rule_valid_datetime($date, $format)) {
    $dt_now = new datetime('now');
    $dt_value = datetime::createfromformat($format, $date);
    $interval = @$dt_value->diff($dt_now);
    if (false !== $interval) {
      if (0 === $interval->invert) {
        $result = sesto_rule_greater_than($interval->y, $years, $equal);
      }
    }
  }
  return $result;
}

