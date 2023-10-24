<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_struct_set(object|string $object_or_class, array $config, string $prefix = 'set_'): void
{
  $public_methods = get_class_methods($object_or_class);
  foreach ($config as $key => $value) {
    $method = $prefix . $key;
    if (in_array($public_methods[$method])) {
      $this->$method($value);
    }
  }
}
