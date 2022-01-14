<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/db/result.php';

final class sesto_pgsql_result implements sesto_db_result
{

  private $result;

  public function __construct($result)
  {
    if (!is_resource($result)) {
      throw new exception(sprintf('Invalid argument. Resource expected %s got', gettype($result)));
    }
    $this->result = $result;
  }

  public function fetch_array(int $type = PGSQL_BOTH)
  {
    return pg_fetch_array($this->result, null, $type);
  }

  public function fetch_object()
  {
    return pg_fetch_object($this->result);
  }

  public function fetch_row(): ?array
  {
    $result = $this->fetch_array(PGSQL_ASSOC);
    if (false === $result) {
      $result = null;
    }
    return $result;
  }
  public function num_rows()
  {
    return pg_num_rows($this->result);
  }

  public function affected_rows(): int
  {
    return pg_affected_rows($this->result);
  }

}

