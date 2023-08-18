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
    require_once SESTO_DIR . '/html/element.php';
    require_once SESTO_DIR . '/html/build.php';
  }

  public function teardown()
  {

  }

  public function t_textarea(test $t)
  {
    $element = sesto_html_element(
      'textarea',
      ['name' => 'my-input',
        'readonly'],
      'this is a test');

    $t->wie = '<textarea name="my-input" readonly>this is a test</textarea>';
    $t->wig = sesto_html_build($element);
    $t->pass_if($t->wie === $t->wig);
  }
}
