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
    require_once SESTO_DIR . '/sql/build_update.php';
  }

  public function t_data(test $t)
  {
    $struct = new sesto_sql_update();
    $struct->table = 'mytable';
    $struct->record['id'] = 1;
    $struct->record['name'] = ["CONCAT ('Naranza', ' ', 'Sesto')"];
    $t->wie = "update mytable set id = :id, name = CONCAT ('Naranza', ' ', 'Sesto')";
    $t->wig = sesto_sql_build_update($struct);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_not_prepared(test $t)
  {
    $struct = new sesto_sql_update();
    $struct->table = 'mytable';
    $struct->record['id'] = 1;
    $struct->record['name'] = "CONCAT ('Naranza', ' ', 'Sesto')";
    $t->wie = "update mytable set id = 1, name = CONCAT ('Naranza', ' ', 'Sesto')";
    $t->wig = sesto_sql_build_update($struct, false);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_where(test $t)
  {
    $struct = new sesto_sql_update();
    $struct->table = 'mytable';
    $struct->record['id'] = 1;
    $struct->record['name'] = "'sesto'";
    $struct->where['a'] = ['id =', 1];
    $struct->where['b'] = ['name =', 'pippo'];
    $t->wie = "update mytable set id = :id, name = :name where (id = :a) and (name = :b)";
    $t->wig = sesto_sql_build_update($struct);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_returning(test $t)
  {
    $struct = new sesto_sql_update();
    $struct->table = 'mytable';
    $struct->record['temp_lo'] = ["temp_lo+1"];
    $struct->record['temp_hi'] = ["temp_lo+15"];
    $struct->where['city'] = ['city =', 'San Francisco'];
    $struct->where['date'] = ['date =', '2003-07-03'];
    $struct->returning[] = "temp_lo";
    $struct->returning[] = "temp_hi";
    $t->wie = "update mytable set temp_lo = temp_lo+1, temp_hi = temp_lo+15 where (city = :city) and (date = :date) returning temp_lo, temp_hi";
    $t->wig = sesto_sql_build_update($struct);
    $t->pass_if($t->wie === $t->wig);
  }

}

