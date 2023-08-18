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
    require_once SESTO_DIR . '/fscache/write.php';
  }

  public function teardown()
  {

  }

  public function t_unable_to_write(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_fscache_write('/proc/test', 'naranza');
    error_clear_last();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_write_success(test $t)
  {
    $temp_file = tempnam(sys_get_temp_dir(), 'cache_write_test.txt');
    $t->wie = true;
    $t->wig = sesto_fscache_write($temp_file, 'naranza');
    $t->pass_if($t->wie === $t->wig);
  }


}

