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
    require_once SESTO_DIR . '/route/struct.php';
  }

  public function t_struct(test $t)
  {
    $t->wie = [
      'id' => '',
      'url_base' => '',
      'url_path' => '',
      'url_relative' => '',
      'dirname' => '',
      'filename' => ''];
    $t->wig = sesto_route_struct();
    $t->pass_if($t->wie === $t->wig);
  }
}
