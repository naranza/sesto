<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_sql_select
{
    public array $cols = [];
    public string $from = '';
    public array $join = [];
    public array $where = [];
    public array $group = [];
    public array $order = [];
    public int $limit = 0;
    public int $offset = 0;
}
