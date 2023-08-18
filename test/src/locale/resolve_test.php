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
    require_once SESTO_DIR . '/locale/resolve.php';
  }

  public function t_language_and_region(test $t)
  {
    $t->wie = [
      'locale' => 'en_GB',
      'primary_language' => 'en',
      'region' => 'GB'
    ];

    $t->wig = sesto_locale_resolve('en_GB');
    print_r($t->wig);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_only_language(test $t)
  {
    $t->wie = [
      'locale' => 'en',
      'primary_language' => 'en',
      'region' => ''
    ];

    $t->wig = sesto_locale_resolve('en');
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_with_variant(test $t)
  {
    $t->wie = [
      'locale' => 'de-CH-1901',
      'primary_language' => 'de',
      'region' => 'CH'
    ];

    $t->wig = sesto_locale_resolve('de-CH-1901');
    $t->pass_if($t->wie === $t->wig);
  }
}
