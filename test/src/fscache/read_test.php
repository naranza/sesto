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
    require_once SESTO_DIR . '/fscache/read.php';
  }

  public function teardown()
  {

  }

  public function t_does_not_exists(test $t)
  {
    $t->wie = null;
    $t->wig = sesto_fscache_read(uniqid());
    error_clear_last();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_exists(test $t)
  {
    $t->wie = 'naranza';
    $t->wig = trim(sesto_fscache_read(__DIR__ . '/cache_file.txt'));
    $t->pass_if($t->wie === $t->wig);
  }


}

