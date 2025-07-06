<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

interface bateo_datalist_interface
{

  public function num_written(): int;

  public function open();

  public function write(string $value);

  public function read(): string;

  public function close();

  public function destroy();
}
