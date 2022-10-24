<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysqlstmt_execute(mysqli $db, string $query, string $types, array $values): array
{
  /* pbe = prepare-bind-execute */
  $pbe = [
    'success' => false,
    'stmt' => false,
    'error' => ''
  ];
  $pbe['stmt'] = $db->prepare($query);
  if (false !== $pbe['stmt']) {
    $result = $pbe['stmt']->bind_param($types, ...$values);
    if (false !== $result) {
      $pbe['success'] = $pbe['stmt']->execute();
      if (false === $pbe['success']) {
        $pbe['error'] = $db->error;
      }
    } else {
      $pbe['error'] = $db->error;
    }
  } else {
    $pbe['error'] = $db->error;
  }
  return $pbe;
}

