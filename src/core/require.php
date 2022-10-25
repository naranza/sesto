<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/core/path.php';

function sesto_require(string $library): void
{
  static $cache = [];
  if (isset($cache[$library])) {
    return;
  }
  $parts = explode('.', $library);
  $module = $parts[0] ?? '';
  $submodule = $parts[1] ?? '';
  $file = $parts[2] ?? '';
  if ('' === $module) {
    throw new exception('empty module');
  }
  if ('' === $submodule) {
    throw new exception('empty submodule');
  }
  if ('' === $file) {
    throw new exception('empty file');
  }
  $module_dir = sesto_path($module);
  if ('' === $module_dir) {
    throw new exception(sprintf('No directory found for module %s', $module));
  }
  $path = $module_dir . '/' . $submodule . '/' . $file . '.php';

  $result = require_once $path;
  if (false === $result) {
    throw new exception(error_get_last()['message']);
  }
  $cache[$library] = true;
}
