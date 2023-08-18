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
    require_once SESTO_DIR . '/rule/valid_datetime.php';
  }

  public function teardown()
  {

  }

  public function t_invalid_date(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_valid_datetime('0123456789.22', 'Y-m-d');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_invalid_format(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_valid_datetime('2010-12-15', 'yyyy-mm-dd');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_warning_parsed_date_was_invalid(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_valid_datetime('2019-04-30', 'Y-d-m');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_ok(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_rule_valid_datetime('2019-04-30', 'Y-m-d');
    $t->pass_if($t->wie === $t->wig);
  }

}

