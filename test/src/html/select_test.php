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
    require_once SESTO_DIR . '/html/select.php';
  }

  public function teardown()
  {

  }

  public function t_execute(test $t)
  {
    $t->wie = 'deallocate stmt1';
    $attribs = [
      'name' => 'record[color]',
      'id' => 'record[color]',
      'class' => 'toco-123'
    ];
    $options = [
      '1' => 'Blue',
      '2' => 'Orange'
    ];
    $t->wig = sesto_html_select($attribs, '1', $options);
    $t->pass_if($t->wie === $t->wig);
  }

}

