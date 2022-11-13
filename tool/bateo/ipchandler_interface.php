<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

interface bateo_ipchandler_interface
{

  public function save(int $id, string $ipcmsg): bool;

  public function load(int $id): string;

  public function delete(int $id): bool;

}
