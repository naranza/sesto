<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_qfilter_eval(string $field, string $operator, $value): array
{
  $error = '';
  switch ($operator) {
    case 'equal':
      $result = $field == $value;
      break;
    case 'not_equal':
      $result = $field != $value;
      break;
    case 'greater':
      $result = $field > $value;
      break;
    case 'greater_than':
      $result = $field >= $value;
      break;
    case 'less':
      $result = $field < $value;
      break;
    case 'less_than':
      $result = $field <= $value;
      break;
    case 'in':
      $result = in_array($field, $value);
      break;
    case 'not_in':
      $result = !in_array($field, $value);
      break;
    case 'like':
    case 'not_like':
    case 'between':
    case 'notBetween':
    case 'isNull':
    case 'isNotNull':
    default:
      $error = 'unknown operator';
      break;
  }
  return [$result, $error];
}
