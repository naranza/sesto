<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_format($exp): string
{
  $type = gettype($exp);
  if (is_string($exp)) {
    return '(' . $type . ') \'' . $exp . '\'';
  } elseif (is_int($exp) || is_float($exp) || is_double($exp)) {
    return '(' . $type . ') ' . strval($exp);
  } elseif (is_array($exp)) {
    return '(' . $type . ') ' . json_encode($exp);
  } elseif (is_null($exp)) {
    return 'null';
  } elseif (is_bool($exp)) {
    return '(' . $type . ') ' . ($exp ? 'true' : 'false');
  } elseif ($exp instanceof throwable) {
    return '(' . get_class($exp) . ')';
  } elseif (is_object($exp)) {
    if (method_exists($exp, '__toString')) {
      return (string) ($exp);
    } else {
      return '(' . get_class($exp) . ')';
    }
  } else {
    return '(' . $type . ') ' . 'unknown';
  }
}
