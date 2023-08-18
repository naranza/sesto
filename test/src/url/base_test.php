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
    require_once SESTO_DIR . '/url/base.php';
  }

  public function t_test1(test $t)
  {
    // document root ending with slash
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/';
    $t->wie = '/';
    $t->wig = sesto_url_base();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test2(test $t)
  {
    // document root ending without slash
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www';
    $t->wie = '/';
    $t->wig = sesto_url_base();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test3(test $t)
  {
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/test/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/';
    $t->wie = '/test';
    $t->wig = sesto_url_base();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test4(test $t)
  {
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/test/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www';
    $t->wie = '/test';
    $t->wig = sesto_url_base();
    $t->pass_if($t->wie === $t->wig);
  }
}
