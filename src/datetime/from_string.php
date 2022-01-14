<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) 2009-20 Andrea Davanzo - www.naranza.com
 * License MPL v2.0. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_datetime_from_string(string $string, string $format, datetimezone $timezone): ?datetime
{
  $date = date_create_from_format($format, $string, $timezone);
  $result = null;
  if (false !== $date) {
    if (date_get_last_errors()['warning_count'] == 0 && date_get_last_errors()['error_count'] == 0){
      $result = $date;
    }
  }

  return $result;
}

