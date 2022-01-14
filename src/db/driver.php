<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

interface sesto_db_driver
{

  public function connect(array $config);

  public function close();

  public function escape(string $string): string;

  public function query(string $query);

  public function quote($value);

}

