<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_qfilter_pgsql(array $expression, int $position): array
{
  $error = '';
  $result = $expression[0] ?? '';
  $value = $position > 0 ? '$'. $position : ($expression[2] ?? '');
  switch ($expression[1] ?? '') {
    case 'equal':
      $result .=  ' = ' . $value;
      break;
    case 'not_equal':
      $result .=  ' <> ' . $value;
      break;
    case 'greater':
      $result .=  ' > ' . $value;
      break;
    case 'greater_than':
      $result .=  ' >= ' . $value;
      break;
    case 'less':
      $result .=  ' < ' . $value;
      break;
    case 'less_than':
      $result .=  ' <= ' . $value;
      break;
    default:
      $error = 'unknown operator';
      break;
  }
  return [$result, $error];
}
