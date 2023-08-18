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
    require_once SESTO_DIR . '/pgsql/query.php';
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

  public function t_invalid_type(test $t)
  {
    $t->wie = 1000;
    try {
      $t->failed('Exception expected');
      $result = sesto_pgsql_query(1234, 'query');
    } catch (exception $ex) {
      $t->wig = $ex->getcode();
      $t->pass_if($t->wie === $t->wig);
    }
  }

  public function t_error(test $t)
  {
    $t->wie = 1002;
    try {
      $t->failed('Exception expected');
      $result = sesto_pgsql_query($this->link, 'query');
    } catch (exception $ex) {
      $t->wig = $ex->getcode();
      $t->pass_if($t->wie === $t->wig);
      error_clear_last();
    }
  }

  public function t_valid(test $t)
  {
    $t->wie = 'pgsql result';
    $result = sesto_pgsql_query($this->link, 'select 1');
    $t->wig = sesto_type_get($result);
    $t->pass_if($t->wie === $t->wig);
  }
}

