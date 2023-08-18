<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

use bateo_test as test;

class bateo_testcase implements bateo_testcase_interface
{

  public function setup()
  {
    require_once SESTO_DIR . '/sql/where.php';
  }

  public function teardown()
  {

  }

  public function t_empty(test $t)
  {
    $t->wie = '';
    $t->wig = sesto_sql_where([]);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_data(test $t)
  {
    $t->wie = '(a = 12) and (b = 13)';
    $t->wig = sesto_sql_where(['a = 12', 'b = 13']);
    $t->pass_if($t->wie === $t->wig);
  }

}

