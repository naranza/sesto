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
    require_once SESTO_DIR . '/route/path.php';
  }

  public function t_test_root(test $t)
  {
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['QUERY_STRING'] = '';
    $t->wie = '/';
    $t->wig = sesto_url_path();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_root_with_query(test $t)
  {
    $_SERVER['REQUEST_URI'] = '/?id=1';
    $_SERVER['QUERY_STRING'] = 'id=1';
    $t->wie = '/';
    $t->wig = sesto_url_path();
    $t->pass_if($t->wie === $t->wig);
  }
}
