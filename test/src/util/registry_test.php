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
    require_once SESTO_DIR . '/util/registry.php';
  }

  public function t_set_and_get_all(test $t)
  {
    $t->wie = ['test' => '123'];
    sesto_registry('test', '123');
    $t->wig = sesto_registry();
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_get_not_exists(test $t)
  {
    $t->wie = null;
    $t->wig = sesto_registry(uniqid());
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_get(test $t)
  {
    sesto_registry('test2', '456');
    $t->wie = '456';
    $t->wig = sesto_registry('test2');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_delete(test $t)
  {
    sesto_registry('test', null);
    $t->wie = ['test2' => '456'];
    $t->wig = sesto_registry();
    $t->pass_if($t->wie == $t->wig);
  }
}
