<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_date_convert_format(string $date, string $from_format, string $to_format): string
{
  $result = '';
  $dt = datetime::createfromformat($from_format, $date);
  if (false !== $dt) {
    $result = $dt->format($to_format);
    if (false === $result) {
      $result = '';
    }
  }
  return $result;
}

