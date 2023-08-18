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
    require_once SESTO_DIR . '/util/load_config.php';
    require_once SESTO_DIR . '/type/check.php';
    $this->config = sesto_load_config(SESTO_TEST_CONF_DIR . '/db.php');
  }

  public function teardown()
  {

  }

  public function t_exception(test $t)
  {
    $t->wie = 1001;
    try {
      sesto_pgsql_connect(uniqid(), uniqid(), uniqid(), uniqid());
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->wig = $ex->getcode();
      $t->pass_if($t->wie === $t->wig);
    }
  }

  public function t_connect(test $t)
  {
    $t->wie = 'pgsql link';
    $t->wig = sesto_type_get(sesto_pgsql_connect(
      $this->config['hostname'],
      $this->config['username'],
      $this->config['password'],
      $this->config['database']));
    $t->pass_if($t->wie === $t->wig);
  }

}

