<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

interface sesto_db_stmt
{

  public function __construct(sesto_db_driver $driver, string $name);

  public function prepare(string $sql);

  public function bind(int $index, $value, string $type = null);

  public function execute();

  public function deallocate();

}
