<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/ipchandler_interface.php';

class bateo_ipchandler_file implements bateo_ipchandler_interface
{

  public function save(int $id, string $ipcmsg): bool
  {
    $filename = sys_get_temp_dir() . '/' . $id . '.ipcmsg';
    return (bool) file_put_contents($filename, $ipcmsg);
  }

  public function load(int $id): string
  {
    $filename = sys_get_temp_dir() . '/' . $id . '.ipcmsg';
    return file_get_contents($filename);
  }

  public function delete(int $id): bool
  {
    $filename = sys_get_temp_dir() . '/' . $id . '.ipcmsg';
    return unlink($filename);
  }

}
