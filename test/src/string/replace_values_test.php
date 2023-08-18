<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

use bateo_test as test;

class james_bond {
   public function __toString()
   {
     return 'Bond';
   }
}

class bateo_testcase
{

  public function setup()
  {
    require_once SESTO_DIR . '/string/replace_values.php';
  }

  public function t_simple(test $t)
  {
    $t->wie = 'My name is Bond, James Bond';
    $t->wig = sesto_string_replace_values(
      'My name is {surname}, {name} {surname}',
      ['name' => 'James', 'surname' => 'Bond']);
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_change_char(test $t)
  {
    $t->wie = 'My name is Bond, James Bond';
    $t->wig = sesto_string_replace_values(
      'My name is %surname%, %name% %surname%',
      ['name' => 'James', 'surname' => 'Bond'],
      '%',
      '%'
    );
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_nothing_changed(test $t)
  {
    $t->wie = 'My name is {surname}, {name} {surname}';
    $t->wig = sesto_string_replace_values(
      'My name is {surname}, {name} {surname}',
      ['name1' => 'James', 'surname1' => 'Bond']
    );
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_value_as_object(test $t)
  {
    $t->wie = 'My name is Bond, James Bond';
    $t->wig = sesto_string_replace_values(
      'My name is {surname}, {name} {surname}',
      ['name' => 'James', 'surname' => new james_bond()]
    );
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_value_as_integer(test $t)
  {
    $t->wie = 'My name is Bond, James Bond aka 007';
    $t->wig = sesto_string_replace_values(
      'My name is {surname}, {name} {surname} aka 00{number}',
      ['name' => 'James', 'surname' => new james_bond(), 'number' => 7]
    );
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_value_as_array(test $t)
  {
    $t->wie = 'My name is Bond, James Bond aka 00{number}';
    $t->wig = sesto_string_replace_values(
      'My name is {surname}, {name} {surname} aka 00{number}',
      ['name' => 'James', 'surname' => new james_bond(), 'number' => []]
    );
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_value_as_bool(test $t)
  {
    $t->wie = 'My name is 1, James 1';
    $t->wig = sesto_string_replace_values(
      'My name is {surname}, {name} {surname}',
      ['name' => 'James', 'surname' => true ]
    );
    $t->pass_if($t->wie === $t->wig);
  }

}
