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
    require_once SESTO_DIR . '/string/trim.php';
  }

  public function t_string(test $t)
  {
    $t->wie = 'string';
    $t->wig = sesto_string_trim('string');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_whitespace_start(test $t)
  {
    $t->wie = 'string';
    $t->wig = sesto_string_trim('  string');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_whitespace_end(test $t)
  {
    $t->wie = 'string';
    $t->wig = sesto_string_trim('string  ');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_whitespace_start_and_end(test $t)
  {
    $t->wie = 'string';
    $t->wig = sesto_string_trim('  string  ');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_whitespace_new_line_and_tab(test $t)
  {
    $t->wie = 'string';
    $t->wig = sesto_string_trim("  \nstring\t   ");
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_utf8(test $t)
  {
    $t->wie = 'string';
    $t->wig = sesto_string_trim(mb_convert_encoding("\xa0string\xa0", 'UTF-8', 'ISO-8859-1'));
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_charlist(test $t)
  {
    $t->wie = 'string&string';
    $t->wig = sesto_string_trim('&&string&string&&', '&');
    $t->pass_if($t->wie == $t->wig);
  }

  public function t_chinese(test $t)
  {
    $t->wie = '细绳';
    $t->wig = sesto_string_trim('  细绳  ');
    $t->pass_if($t->wie == $t->wig);
  }

}

