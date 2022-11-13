<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

interface bateo_datalist_interface
{

  public function num_written(): int;

  public function open();

  public function write(string $value);

  public function read(): string;

  public function close();

  public function destroy();

}
