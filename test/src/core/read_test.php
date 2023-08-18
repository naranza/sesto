<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

use bateo_test as test;

class bateo_testcase implements bateo_testcase_interface
{

  public function setup()
  {
    require_once SESTO_DIR . '/core/loader.php';
  }

  public function t_installed(test $t)
  {
    $t->wie = [];
    $t->wig = sesto_installed();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_install(test $t)
  {
    $t->wie = count(sesto_installed()) + 1;
    sesto_install('a', 'b');
    $t->wig = count(sesto_installed());
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_require_error(test $t)
  {
    try {
      $t->wig = sesto_require('test');
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->passed($ex->getmessage());
    }
  }

  public function t_module_not_installed(test $t)
  {
    try {
      sesto_require('not_installed/function');
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->passed($ex->getmessage());
    }
  }

  public function t_not_found(test $t)
  {
    sesto_install('testme', __DIR__);
    try {
      sesto_require('testme/123456');
      $t->failed('Exception expected');
    } catch (exception $ex) {
      $t->passed($ex->getmessage());
    }
  }

  public function t_ok(test $t)
  {
    sesto_install('testme', __DIR__);
    sesto_require('testme/require_module');
    $t->pass_if(function_exists('sesto_test_require_test_function'), 'Function not found');
  }

}

