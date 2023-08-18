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
    require_once SESTO_DIR . '/string/empty.php';
  }

  public function t_empty(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_string_empty('');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_whitespace(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_string_empty('    ');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_zero(test $t)
  {
    $t->wie = false;
    $t->wig = sesto_string_empty('0');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_tab(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_string_empty("\t");
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_newline(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_string_empty("\n");
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_newline_and_others(test $t)
  {
    $t->wie = true;
    $t->wig = sesto_string_empty("\n \t \r");
    $t->pass_if($t->wie == $t->wig);
  }

}

