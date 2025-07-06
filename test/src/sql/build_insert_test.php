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
    require_once SESTO_DIR . '/sql/build_insert.php';
  }

  public function t_data(test $t)
  {
    $struct = new sesto_sql_insert();
    $struct->table = 'mytable';
    $struct->record['id'] = 1;
    $struct->record['name'] = "'sesto'";
    $t->wie = "insert into mytable (id, name) values (:id, :name)";
    $t->wig = sesto_sql_build_insert($struct);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_not_prepared(test $t)
  {
    $struct = new sesto_sql_insert();
    $struct->table = 'mytable';
    $struct->record['id'] = 1;
    $struct->record['name'] = "'sesto'";
    $t->wie = "insert into mytable (id, name) values (1, 'sesto')";
    $t->wig = sesto_sql_build_insert($struct, false);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_returning(test $t)
  {
     $struct = new sesto_sql_insert();
    $struct->table = 'mytable';
    $struct->record['id'] = 1;
    $struct->record['name'] = "'sesto'";
    $struct->returning[] = "id";
    $struct->returning[] = "name";
    $t->wie = "insert into mytable (id, name) values (:id, :name) returning id, name";
    $t->wig = sesto_sql_build_insert($struct);
    $t->pass_if($t->wie === $t->wig);
  }

}