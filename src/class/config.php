<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_class_config(object $object, array $config): object
{
  $public_properties = get_class_vars(get_class($object));
  foreach ($config as $key => $value) {
    if (array_key_exists($key, $public_properties)) {
      $object->$key = $value;
    }
  }
  return $object;
}
