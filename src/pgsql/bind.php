<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

final class sesto_pgsql_bind
{

  private $types;
  private $values;

  public function __construct()
  {
    $this->reset();
  }

  public function set(int $index, $value, string $type): void
  {
    $this->types[$index] = $type;
    $this->values[$index] = $value;
  }

  public function types(): array
  {
    ksort($this->types);
    return $this->types;
  }

  public function values(): array
  {
    ksort($this->values);
    return $this->values;
  }

  public function reset()
  {
    $this->types = [];
    $this->values = [];
  }

}

