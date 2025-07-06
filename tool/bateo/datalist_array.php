<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once BATEO_DIR . '/datalist_interface.php';

class bateo_datalist_array implements bateo_datalist_interface
{

  private $data = [];
  private $written = 0;
  private $pos = 0;

  public function num_written(): int
  {
    return $this->written;
  }

  public function open()
  {
    $this->pos = 0;
  }

  public function write(string $value)
  {
    if (0 == preg_match('/\S/', $value)) {
      throw new exception('Empty string not allowed');
    }
    $this->data[] = $value;
    $this->written++;
  }

  public function read(): string
  {
    if (0 === $this->pos) {
      $return = current($this->data);
    } else {
      $return = next($this->data);
    }
    $this->pos++;
    return trim((string) $return);
  }

  public function close()
  {

  }

  public function destroy()
  {
    $this->data = [];
  }
}
