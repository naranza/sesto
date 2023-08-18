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
    require_once SESTO_DIR . '/type/get.php';
  }

  public function teardown()
  {

  }

  public function t_int(test $t)
  {
    $t->wie = 'integer';
    $t->wig = sesto_type_get(123);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_object(test $t)
  {
    $t->wie = 'Exception';
    $t->wig = sesto_type_get(new exception('123'));
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_resource(test $t)
  {
    $handler = fopen('test.txt', 'w');
    $t->wie = 'stream';
    $t->wig = sesto_type_get($handler);
    $t->pass_if($t->wie === $t->wig);
  }

}

