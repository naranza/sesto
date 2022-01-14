<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

interface sesto_db_result
{

  public function fetch_array(int $type);

  public function fetch_object();

  public function fetch_row(): ?array;

  public function num_rows();

  public function affected_rows(): int;

}

