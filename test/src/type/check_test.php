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
    require_once SESTO_DIR . '/type/check.php';
  }

  public function teardown()
  {

  }

  public function t_success(test $t)
  {
    $t->wie = '';
    $t->wig = sesto_type_check('this is a test', 'string');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_failed(test $t)
  {
    $t->wie = "Invalid type: 'string' expected 'integer' got";
    $t->wig = sesto_type_check(1234, 'string');
    $t->pass_if($t->wie === $t->wig);
  }

}

