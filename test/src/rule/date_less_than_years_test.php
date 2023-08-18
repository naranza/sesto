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
    require_once SESTO_DIR . '/rule/date_less_than_years.php';
  }

  public function teardown()
  {

  }

  public function t_invalid_date(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_date_less_than_years('0123456789.22', 'Y-m-d', 18);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_invalid_format(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_date_less_than_years('2010-12-15', 'yyyy-mm-dd', 18);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_warning_parsed_date_was_invalid(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_date_less_than_years('2019-04-30', 'Y-d-m', 18);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_false(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_date_less_than_years('9000-04-30', 'Y-m-d', 18);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_ok_not_equal(test $t)
  {
    $dt = new datetime();
    $current_year = (int) $dt->format("Y");
    $diff = 2;
    $value = $current_year - $diff . $dt->format("-m-d");
    $t->wie = false;
    $t->wig = sesto_rule_date_less_than_years($value, 'Y-m-d', $diff, false);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_ok_equal(test $t)
  {
    $dt = new datetime();
    $current_year = (int) $dt->format("Y");
    $diff = 2;
    $value = $current_year - $diff . $dt->format("-m-d");
    $t->wie = true;
    $t->wig = sesto_rule_date_less_than_years($value, 'Y-m-d', $diff, true);
    $t->pass_if($t->wie === $t->wig);
  }

}

