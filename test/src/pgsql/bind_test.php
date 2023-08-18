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
    require_once SESTO_DIR . '/pgsql/bind.php';
  }

  public function teardown()
  {

  }

  public function t_set(test $t)
  {
    $t->wie = null;
    $bind = new sesto_pgsql_bind();
    $t->wig = $bind->set(1, 'andrea' , 'text');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_types(test $t)
  {
    $t->wie = [1 => 'text' , 2 => 'int'];
    $bind = new sesto_pgsql_bind();
    $bind->set(1, 'andrea' , 'text');
    $bind->set(2, 1234 , 'int');
    $t->wig = $bind->types();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_values(test $t)
  {
    $t->wie = [1 => 'andrea' , 2 => 1234];
    $bind = new sesto_pgsql_bind();
    $bind->set(1, 'andrea' , 'text');
    $bind->set(2, 1234 , 'int');
    $t->wig = $bind->values();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_types_sorted(test $t)
  {
    $t->wie = [1 => 'text' , 2 => 'int'];
    $bind = new sesto_pgsql_bind();
    $bind->set(2, 1234 , 'int');
    $bind->set(1, 'andrea' , 'text');
    $t->wig = $bind->types();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_values_sorted(test $t)
  {
    $t->wie = [1 => 'andrea' , 2 => 1234];
    $bind = new sesto_pgsql_bind();
    $bind->set(2, 1234 , 'int');
    $bind->set(1, 'andrea' , 'text');
    $t->wig = $bind->values();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_reset(test $t)
  {
    $t->wie = [0 => [] , 1 => []];
    $bind = new sesto_pgsql_bind();
    $bind->set(1, 'andrea' , 'text');
    $bind->set(2, 1234 , 'int');
    $bind->reset();
    $t->wig = [$bind->types(), $bind->values()];
    $t->pass_if($t->wie === $t->wig);
  }
}

