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
    require_once SESTO_DIR . '/app/config.php';

  }

  public function teardown()
  {

  }

  public function t_test1(test $t)
  {
    $t->wie = [
      'app_root_dir' => '',
      'app_env' => ''];
    $t->wig = sesto_app_config();
    $t->pass_if($t->wie === $t->wig);
  }

}

