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
    require_once SESTO_DIR . '/sql/build_count.php';
  }

  public function t_complex(test $t)
  {
    $struct = new sesto_sql_select();
    $struct->from = 'mytable';

    $struct->cols[] = "col1";
    $struct->cols[] = "col2";

    $struct->join[] = "join1";
    $struct->join[] = "join2";

    $struct->where['w1'] = ['where1 =', 1];
    $struct->where['w2'] = ['where2'];

    $struct->group[] = "group1";
    $struct->group[] = "group2";

    $struct->order[] = "order1";
    $struct->order[] = "order1";

    $struct->limit = 10;
    $struct->offset = 20;

    $t->wie = "select count(1) as num_rows from mytable join1 join2 where (where1 = :w1) and (where2) group by group1, group2";
    $t->wig = sesto_sql_build_count($struct);
    $t->pass_if($t->wie === $t->wig);
  }

}