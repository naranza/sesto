<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

function sesto_get_param(string $key, $default = null)
{
  $value = $default;
  if (isset($_GET[$key])) {
    $value = $_GET[$key];
  } elseif (isset($_POST[$key])) {
    $value = $_POST[$key];
  } elseif (isset($_COOKIE[$key])) {
    $value = $_COOKIE[$key];
  } elseif (isset($_REQUEST[$key])) {
    $value = $_REQUEST[$key];
  } elseif (isset($_SERVER[$key])) {
    $value = $_SERVER[$key];
  } elseif (isset($_FILES[$key])) {
    $value = $_FILES[$key];
  } elseif (isset($_ENV[$key])) {
    $value = $_ENV[$key];
  }
  return $value;
}

