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
    require_once SESTO_DIR . '/rule/only_digits.php';
  }

  public function teardown()
  {

  }

  public function t_decimal(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_only_digits('0123456789.22');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_letter(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_only_digits('0123456789a');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_ok(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_rule_only_digits('0123456789');
    $t->pass_if($t->wie === $t->wig);
  }


}

