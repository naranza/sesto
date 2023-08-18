<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

use bateo_test as test;

class bateo_testcase
{

  public function setup()
  {
    require_once SESTO_DIR . '/sql/update.php';
  }

  public function teardown()
  {

  }

  public function t_data(test $t)
  {
    $t->wie = 'update mytable set id = 1, name = sesto';
    $t->wig = sesto_sql_update('mytable', ['id' => 1, 'name' => 'sesto']);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_where(test $t)
  {
    $t->wie = 'update mytable set id = 1, name = sesto where (id =12)';
    $t->wig = sesto_sql_update('mytable', ['id' => 1, 'name' => 'sesto'], ['id =12']);
    $t->pass_if($t->wie === $t->wig);
  }

}

