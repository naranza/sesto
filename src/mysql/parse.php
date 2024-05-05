<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_mysql_parse($conn, string $query, array $params): array
{
  $sql = preg_replace_callback(
    '/:([a-zA-Z_][a-zA-Z0-9_]*)/',
    function ($matches) use (&$types, &$values, $params) {
      $paramName = $matches[1];

      if (array_key_exists($paramName, $params)) {
        $types .= 's';
        $values[] = $params[$paramName];
        return '?';
      } else {
        throw new Exception("You are missing a parameter key: {$paramName}");
      }
    },
    $query
  );

  return [
    0 => $sql,
    1 => $types,
    2 => $values,
  ];
}
