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
    require_once SESTO_DIR . '/url/relative.php';
  }

  public function t_test_root(test $t)
  {
    $t->wie = '/';
    $t->wig = sesto_url_relative('/', '/');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_root_with_subdir(test $t)
  {
    $t->wie = '/test/';
    $t->wig = sesto_url_relative('/test/', '/');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_basedir(test $t)
  {
    $t->wie = '/';
    $t->wig = sesto_url_relative('/', '/admin');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_basedir_with_subdir(test $t)
  {
    $t->wie = '/test/';
    $t->wig = sesto_url_relative('/test/', '/admin');
    $t->pass_if($t->wie === $t->wig);
  }
}
