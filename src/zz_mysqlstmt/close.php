<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysqlstmt_close(array $pbe): void
{
  if (isset($pbe['stmt']) && $pbe['stmt'] instanceof mysqli_stmt) {
    $pbe['stmt']->close();
  }
}

