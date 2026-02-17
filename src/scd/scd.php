<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class sesto_scd {

  public array|string|object $callable;
  public array $args = [];
  public string $require = '';

  function __construct(array|string|object $callable, array $args = [], string $require = '') {
    $this->callable = $callable;
    $this->args = $args;
    $this->require = $require;
  }
}
