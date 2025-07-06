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
    $t->wie = '';
    $t->wig = sesto_sql_build_where([]);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_data(test $t)
  {
    $t->wie = '(a = 12) and (b = 13)';
    $t->wig = sesto_sql_build_where(['a = 12', 'b = 13']);
    $t->pass_if($t->wie === $t->wig);
  }

}