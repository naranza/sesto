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
    require_once SESTO_DIR . '/http/redirect.php';
  }

  public function teardown()
  {

  }

  public function t_empty(test $t)
  {
    $t->wie = true;
    try {
      sesto_http_redirect('');
      $ex = null;
    } catch (exception $ex) {
    }
    $t->pass_if($ex instanceof exception, 'Exception expected');
  }


  public function t_redirect(test $t)
  {
    $t->wie = true;
    ob_start();
    sesto_http_redirect('https://naranza.com');
    die;
    ns_d(headers_list());
  }
}

