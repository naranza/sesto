<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_mysqlstmt_close(array $pbe): void
{
  if (isset($pbe['stmt']) && $pbe['stmt'] instanceof mysqli_stmt) {
    $pbe['stmt']->close();
  }
}

