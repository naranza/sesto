<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

class sesto_struct
{

  public function __get(string $name): mixed
  {
    throw new exception("__get($name) not allowed on Sesto struct");
  }

  public function __set($name, $value)
  {
    throw new exception("__set($name) not allowed on Sesto struct");
  }

  public function __construct(array $config = [])
  {
    foreach ($config as $key => $value) {
      if (isset($this->$key)) {
        $this->$key = $value;
      }
    }
  }
}
