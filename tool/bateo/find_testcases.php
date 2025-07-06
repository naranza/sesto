<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_find_testcases(string $destination): bateo_datalist_interface
{
  if (is_dir($destination)) {
    require_once BATEO_DIR . '/datalist_file.php';
    require_once BATEO_DIR . '/find_scandir.php';
    $datalist = new bateo_datalist_file(sys_get_temp_dir() . '/bateo-application.list');
    bateo_find_scandir(rtrim($destination, '/'), $datalist);
  } else {
    require_once BATEO_DIR . '/datalist_array.php';
    $datalist = new bateo_datalist_array();
    $datalist->write($destination);
  }
  $datalist->close();
  return $datalist;
}
