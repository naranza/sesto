<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_db_check_connect_config(array $config): array
{
  $errors = [];
  foreach (['hostname', 'database', 'username', 'password'] as $required) {
    if (!array_key_exists($required, $config)) {
      $errors[] = sprintf("'%s' field not found", $required);
    }
  }
  return $errors;
}

