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
    require_once SESTO_DIR . '/fscache/expired.php';
  }

  public function teardown()
  {

  }

  public function t_unable_read(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_fscache_expired('/proc/test', 9000);
    /* error_clear_last(); */
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_not_expired(test $t)
  {
    $temp_file = tempnam(sys_get_temp_dir(), 'cache_write_test.txt');
    $t->wie = false;
    sesto_fscache_write($temp_file, 'naranza');
    $t->wig = sesto_fscache_expired($temp_file, 300);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_expired(test $t)
  {
    $temp_file = tempnam(sys_get_temp_dir(), 'cache_write_test.txt');
    $t->wie = true;
    sesto_fscache_write($temp_file, 'naranza');
    sleep(2);
    $t->wig = sesto_fscache_expired($temp_file, 1);
    $t->pass_if($t->wie === $t->wig);
  }


}

