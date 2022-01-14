<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/rule/valid_datetime.php';

function sesto_convert_datetime_format(string $datetime, string $from_format, string $to_format): ?string
{
  $result = sesto_rule_valid_datetime($datetime, $from_format);
  if (false !== $result) {
    $dt = DateTime::createFromFormat($from_format, $datetime);
    $result = $dt->format($to_format);
  }
  if (false === $result) {
    $result = null;
  }
  return $result;
}

