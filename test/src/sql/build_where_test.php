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
    require_once SESTO_DIR . '/sql/build_where.php';
  }

  public function t_empty(test $t)
  {
    $where = [];
    $t->wie = '';
    $t->wig = sesto_sql_build_where($where);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_data(test $t)
  {
    $where = [
      'x' => ['start_date < end_date'],
      'y' => ['point_y =', 13]
    ];
    $t->wie = '(start_date < end_date) and (point_y = :y)';
    $t->wig = sesto_sql_build_where($where);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_not_prepared(test $t)
  {
    // just to make clear the ,13 is ignored
    $where = [
      'x' => ['start_date < end_date'],
      'y' => ['point_y =', 13]
    ];
    $t->wie = '(start_date < end_date) and (point_y =)';
    $t->wig = sesto_sql_build_where($where, false);
    $t->pass_if($t->wie === $t->wig);
  }


}