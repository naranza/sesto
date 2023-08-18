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
    require_once SESTO_DIR . '/util/ini_set_array.php';
  }

  public function t_set(test $t)
  {
    $t->wie = [
      'display_errors' => 'false',
      'date.timezone' => 'Europe/Vaduz'
    ];
    sesto_ini_set_array($t->wie);
    $t->wig = [
      'display_errors' => ini_get('display_errors'),
      'date.timezone' => ini_get('date.timezone')
    ];
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_get_previous_data(test $t)
  {

    $t->wie = [
      'display_errors' => ini_get('display_errors'),
      'date.timezone' => ini_get('date.timezone')
    ];

    $t->wig = sesto_ini_set_array([
      'display_errors' => 'false',
      'date.timezone' => 'Europe/Astrakhan']
    );
    $t->pass_if($t->wie === $t->wig);
  }
}
