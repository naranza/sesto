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
require_once SESTO_DIR . '/html/normalise.php';

  }

  public function teardown()
  {

  }

  public function t_record(test $t)
  {
    $t->wie = 'record';
    $t->wig = sesto_html_normalise('record[]');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_indexed_record(test $t)
  {
    $t->wie = 'record-test';
    $t->wig = sesto_html_normalise('record[test][]');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_normal(test $t)
  {
    $t->wie = 'record';
    $t->wig = sesto_html_normalise('record');
    $t->pass_if($t->wie === $t->wig);
  }

}

