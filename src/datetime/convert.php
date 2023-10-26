<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/datetime/from_format.php';

function sesto_datetime_convert(string $date, string $from_format, string $to_format, datetimezone $timezone = null): string
{
  $result = '';
  if (null === $timezone) {
    $timezone = new datetimezone(date_default_timezone_get());
  }
  $dt = sesto_datetime_from_format($from_format, $date, $timezone);
  if (null !== $dt) {
    $result = $dt->format($to_format);
    if (false === $result) {
      $result = '';
    }
  }
  return $result;
}
