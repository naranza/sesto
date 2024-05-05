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
    require_once SESTO_DIR . '/util/config.php';
  }

  public function t_test_valid(test $t)
  {
    $t->wie = ['name' => 'sesto'];
    $t->wig = sesto_config(SESTO_TEST_DATA_DIR . '/config' . '/valid.php');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_not_readable(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_config(SESTO_TEST_DATA_DIR . '/config' . '/asdhfkasdk.php');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_not_array(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_config(SESTO_TEST_DATA_DIR . '/config' . '/not_array.php');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_not_defined(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_config(SESTO_TEST_DATA_DIR . '/config' . '/not_defined.php');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_return_array(test $t)
  {
    $t->wie = ['name' => 'sesto'];
    $t->wig = sesto_config(SESTO_TEST_DATA_DIR . '/config' . '/return_array.php');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_missing_extension(test $t)
  {
    $t->wie = ['name' => 'sesto'];
    $t->wig = sesto_config(SESTO_TEST_DATA_DIR . '/config' . '/return_array');
    $t->pass_if($t->wie === $t->wig);
  }

}

