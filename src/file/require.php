<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_require(string $path): array
{
  if (class_exists($class, FALSE) || interface_exists($class, FALSE)) {
    return NULL;
  }
  $filename = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

  $result = @include($filename);
  if ($result === FALSE) {
    $error = error_get_last();
    throw new Exception($error['message']);
  }
  if (!in_array($class, get_declared_classes())) {
    if (!in_array($class, get_declared_interfaces())) {
      throw new Exception("Class '$class' not defined on '$filename'");
    }
  }
}
