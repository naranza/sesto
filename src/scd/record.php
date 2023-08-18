<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

class sesto_scd_record
{

  public readonly array $callable;
  public readonly array $args;
  public readonly string $require;

  public function __construct(array|string|object $callable, array $args = [], string $require = '')
  {
    $this->callable = [
      'callable' => $callable,
      'type' => gettype($callable)
    ];
    $this->args = $args;
    $this->require = $require;
    $callable['type'] = gettype($callable);
  }
}

//function sesto_scd_call(array $spc): mixed
//{
//  if (isset($spc['require'])) {
//    if (!is_file($spc['require']) || !is_readable($spc['require'])) {
//      throw new exception($spc['require'] . ' is not readable');
//    }
//    require_once $spc['require'];
//  }
//  if (!isset($spc['callable'])) {
//    throw new exception($spc['callable'] . ' not defined');
//  } elseif (!is_callable($spc['callable'])) {
//    throw new exception('Function/method not callable');
//  }
//
//  return call_user_func_array($spc['callable'], $spc['args'] ?? []);
//}
