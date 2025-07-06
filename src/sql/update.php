<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_sql_update
{
  public string $table = '';
  public array $record = [];
  public array $returning = [];
}