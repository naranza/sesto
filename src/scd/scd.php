<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

class sesto_scd

{

  public readonly array|string|object $callable;
  public readonly string $require;
  public readonly array $args;

  function __construct(array|string|object $callable, string $require = '', array $args = [])
  {
    $this->callable = $callable;
    $this->require = $require;
    $this->args = $args;
  }
}
