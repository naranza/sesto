<?php

/* =============================================================================
 * This file is part of Sesto by Naranza <http://naranza.com>
 *
 * Copyright (c) 2009-2018 Andrea Davanzo <andrea@naranza.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/db/driver.php';
require_once SESTO_DIR . '/db/stmt.php';

/**
 * @package db
 * @author Andrea Davanzo <andrea@naranza.com>
 * @wildlife
 */
function sesto_db_get_stmt(sesto_db_driver $driver): sesto_db_stmt
{
  if ($driver instanceof sesto_db_pgsql_driver) {
    require_once SESTO_DIR . '/db/pgsql_stmt.php';
    $return = new sesto_db_pgsql_stmt($driver);
  } else {
    throw new exception('unknown driver');
  }
  return $return;
}
