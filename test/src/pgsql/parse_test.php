<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

use bateo_test as test;

class bateo_testcase
{

  public function setup()
  {
    require_once SESTO_DIR . '/pgsql/parse.php';
  }

  public function t_parse(test $t)
  {
    $query = "insert into mytable (id, name) values (:id, :name)";
    $params = [
      'id' => 1,
      'name' => "'sesto'"
    ];

    $t->wie = [
      "insert into mytable (id, name) values ($1, $2)",
      [1 => 1, 2 => "'sesto'"]
    ];
    $t->wig = sesto_pgsql_parse($query, $params);
    $t->pass_if($t->wie === $t->wig);
  }

}