<?php
/* =============================================================================
 * Naranza Bateo, Copyright (c) Andrea Davanzo, License GNU GPL v3.0, bateo.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once BATEO_DIR . '/datalist_interface.php';

class bateo_datalist_file implements bateo_datalist_interface
{

  private $handle;

  private $filename;

  private $written = 0;

  public function __construct(string $filename)
  {
    $this->filename = $filename;
    $this->handle = @fopen($this->filename, 'w+');
  }

  public function num_written(): int
  {
    return $this->written;
  }

  public function open()
  {
    $this->handle = @fopen($this->filename, 'r');
    if (false === $this->handle) {
      $last = error_get_last();
      throw new exception(sprintf('create failed: %s', $last['message'] ?? ''));
    }
  }

  public function write(string $value)
  {
    if (!is_resource($this->handle)) {
      throw new exception('write failed: invalid resource');
    }
    if (0 == preg_match('/\S/', $value)) {
      throw new exception('Empty string not allowed');
    }
    if (false === fwrite($this->handle, trim($value) . PHP_EOL)) {
      throw new exception(sprintf('Write failed: %s', error_get_last()));
    }
    $this->written++;
  }

  public function read(): string
  {
    if (!is_resource($this->handle)) {
      throw new exception('read failed: invalid resource');
    }
    return trim((string) fgets($this->handle));
  }

  public function close()
  {
    if (!is_resource($this->handle)) {
      return;
    }
    fclose($this->handle);
  }

  public function destroy()
  {
    if (!is_resource($this->handle)) {
      return;
    }
    unlink($this->filename);
  }

}
