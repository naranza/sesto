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
    require_once SESTO_DIR . '/dev/dump_session.php';
  }

  public function teardown()
  {

  }

  public function t_return_false(test $t)
  {
    $t->wie = 'Session not started';
    ob_start();
    sesto_dump_session();
    $t->wig = ob_get_contents();
    ob_end_clean();
    $t->pass_if(false !== strpos($t->wig, $t->wie));
  }

  public function t_return_true(test $t)
  {
    $t->wie = 'Session not started';
    ob_start();
    $t->wig = sesto_dump_session(true);
    $contents = ob_get_contents();
    ob_end_clean();
    if (false === strpos($t->wig, $t->wie)) {
      $t->failed('string not found');
    } else if ('' != $contents) {
      $t->failed('function has printed somthing');
    } else {
      $t->passed('ok');
    }
  }

  public function t_alias(test $t)
  {
    $t->wie = 'Session not started';
    ob_start();
    ns_ds();
    $t->wig = ob_get_contents();
    ob_end_clean();
    $t->pass_if(false !== strpos($t->wig, $t->wie));
  }

}

