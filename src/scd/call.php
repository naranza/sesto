<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/scd/scd.php';

function sesto_scd_call(sesto_scd $scd): mixed
{
  if (isset($scd->require)) {
    if (!is_file($scd->require) || !is_readable($scd->require)) {
      throw new exception($scd->require . ' is not readable');
    }
    require_once $scd->require;
  }
  if (!isset($scd->callable)) {
    throw new exception($scd->callable . ' not defined');
  } elseif (!is_callable($scd->callable)) {
    throw new exception('Function/method not callable');
  }

  return call_user_func_array($scd->callable, $scd->args ?? []);
}
