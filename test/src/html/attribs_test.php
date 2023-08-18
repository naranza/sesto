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

require_once SESTO_DIR . '/html/attribs.php';
  }

  public function teardown()
  {

  }

  public function t_record(test $t)
  {
    $t->wie = 'id="record"';
    $t->wig = sesto_html_attribs(['id' => 'record']);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_boolean(test $t)
  {
    $t->wie = 'id="record" readonly';
    $t->wig = sesto_html_attribs(['id' => 'record', 'readonly']);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_integer(test $t)
  {
    $t->wie = 'id="record" 1';
    $t->wig = sesto_html_attribs(['id' => 'record', 1]);
    $t->pass_if($t->wie === $t->wig);
  }

}

