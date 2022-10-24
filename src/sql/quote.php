<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_sql_quote($value)
{
  if (is_int($value)) {
    return $value;
  }
  if (is_float($value) || is_double($value)) {
    return sprintf('%F', $value);
  }
  if (is_bool($value)) {
    return "'" . ($value ? 't' : 'f') . "'";
  }
  if (is_object($value) && method_exists($value, '__toString')) {
    $value = (string) $value;
  }
  if (is_string($value)) {
    return "'" . addcslashes($value, "\000\n\r\\'\"\032") . "'";
  }
  throw new exception('Unable to quote');
}
