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
    require_once SESTO_DIR . '/pgsql/connect.php';
    require_once SESTO_DIR . '/pgsql/quote.php';
    require_once SESTO_DIR . '/util/load_config.php';
    require_once SESTO_DIR . '/type/check.php';
    $config = sesto_load_config(SESTO_TEST_CONF_DIR . '/db.php');
    $this->link = sesto_pgsql_connect(
      $config['hostname'],
      $config['username'],
      $config['password'],
      $config['database']);
  }

  public function teardown()
  {

  }

  public function t_int(test $t)
  {
    $t->wie = 1234;
    $t->wig = sesto_pgsql_quote($this->link, 1234);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_float(test $t)
  {
    $t->wie = 1234.5678;
    $t->wig = sesto_pgsql_quote($this->link, 1234.5678);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_double(test $t)
  {
    $t->wie = (double) 1234.5678;
    $t->wig = sesto_pgsql_quote($this->link, (double) 1234.5678);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_boolean_true(test $t)
  {
    $t->wie = "'t'";
    $t->wig = sesto_pgsql_quote($this->link, true);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_boolean_false(test $t)
  {
    $t->wie = "'f'";
    $t->wig = sesto_pgsql_quote($this->link, false);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_invalid_value_type(test $t)
  {
    $t->wie = 1000;
    try {
      $t->wig = sesto_pgsql_quote($this->link, ['array']);
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->wig = $ex->getcode();
      $t->pass_if($t->wie === $t->wig);
    }
  }

  public function t_invalid_link_type(test $t)
  {
    $t->wie = 1000;
    try {
      $t->wig = sesto_pgsql_quote('link', 'my test string');
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->wig = $ex->getcode();
      $t->pass_if($t->wie === $t->wig);
    }
  }

  public function t_valid(test $t)
  {
    $t->wie = "'can''t be \" π'";
    $t->wig = sesto_pgsql_quote($this->link, "can't be \" π");
    $t->pass_if($t->wie === $t->wig);
  }
}

