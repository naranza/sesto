<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_system_resource_bak(string $name = null, $value = null): mixed
{
  /* init the resource */
  static $cache = [];
  $error = '';
  if (null === $name && null === $value) {
    /* return all cache */
    return [$cache, $error];
  }
  if (null !== $name && null !== $value) {
    /* set the resource */
    $cache[$name] = $value;
  } elseif (null !== $name && null === $value) {
    /* get the resource */
    if (!isset($cache[$name])) {
      $value = null;
      $error = sprintf("Resource '%s' not found", $name);
    } else {
      if (is_string($cache[$name])) {
        /* init the resource */
        if ('&' === $cache[$name][0]) {
          /* it is a reference */
          $referenced = substr($cache[$name], 1);
          list($value, $error) = sesto_system_resource($referenced);
          if ('' === $error) {
            $cache[$name] = &$cache[$referenced];
          }
        } else {
          $path = $cache[$name] . '.php';
          if (is_file($path) && is_readable($path)) {
            $cache[$name] = include $path;
          } else {
            $error = sprintf("'%s' not a file or not readable", $path);
          }
        }
      }
      $value = $cache[$name];
    }
  }
  return [$value, $error];
}
