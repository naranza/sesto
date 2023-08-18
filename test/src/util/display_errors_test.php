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
    require_once SESTO_DIR . '/util/display_errors.php';
  }

  public function t_display_true(test $t)
  {
    sesto_display_errors(true);
    $t->wie = [
      'true',
      'true',
      E_ALL];
    $t->wig = [
      ini_get('display_errors'),
      ini_get('display_startup_errors'),
      error_reporting()];
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_display_false(test $t)
  {
    sesto_display_errors(false);
    $t->wie = [
      'false',
      'false',
      0];
    $t->wig = [
      ini_get('display_errors'),
      ini_get('display_startup_errors'),
      error_reporting()];
    $t->pass_if($t->wie === $t->wig);
  }
}
