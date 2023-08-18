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
    require_once SESTO_DIR . '/rule/string_length.php';
  }

  public function teardown()
  {

  }

  public function t_min_max_null(test $t)
  {
    $t->wie = "Min and max length not set";
    try {
      sesto_rule_string_length('naranza');
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->wig = $ex->getmessage();
      $t->pass_if($t->wie === $t->wig);
    }
  }

  public function t_min_greater_than_max(test $t)
  {
    $t->wie = "Min greater than max";
    try {
      sesto_rule_string_length('naranza', 12, 3);
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->wig = $ex->getmessage();
      $t->pass_if($t->wie === $t->wig);
    }
  }

  public function t_min_true(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_rule_string_length('naranza', 6);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_min_false(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_string_length('naranza', 8);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_max_true(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_rule_string_length('naranza', null, 8);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_max_false(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_string_length('naranza', null, 6);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_min_equals_max(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_rule_string_length('naranza', 7, 7);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_min_equals_max_2(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_rule_string_length('naranza', 4, 4);
    $t->pass_if($t->wie === $t->wig);
  }

}

