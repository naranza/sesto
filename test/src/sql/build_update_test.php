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
    $select = new sesto_sql_update();
    $select->table = 'mytable';
    $select->record['id'] = 1;
    $select->record['name'] = "'sesto'";
    $t->wie = "update mytable set id = 1, name = 'sesto'";
    $t->wig = sesto_sql_build_update($select);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_where(test $t)
  {
    $select = new sesto_sql_update();
    $select->table = 'mytable';
    $select->record['id'] = 1;
    $select->record['name'] = "'sesto'";
    $select->where[] = 'id = 1';
    $select->where[] = "name = 'pippo'";
    $t->wie = "update mytable set id = 1, name = 'sesto' where (id = 1) and (name = 'pippo')";
    $t->wig = sesto_sql_build_update($select);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_returning(test $t)
  {
    $select = new sesto_sql_update();
    $select->table = 'mytable';
    $select->record['temp_lo'] = 'temp_lo+1';
    $select->record['temp_hi'] = "temp_lo+15";
    $select->where[] = "city = 'San Francisco'";
    $select->where[] = "date = '2003-07-03'";
    $select->returning[] = "temp_lo";
    $select->returning[] = "temp_hi";
    $t->wie = "update mytable set temp_lo = temp_lo+1, temp_hi = temp_lo+15 where (city = 'San Francisco') and (date = '2003-07-03') returning temp_lo, temp_hi";
    $t->wig = sesto_sql_build_update($select);
    $t->pass_if($t->wie === $t->wig);
  }

}

