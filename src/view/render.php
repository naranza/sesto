<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.com
 * ========================================================================== */

declare(strict_types=1);

function sesto_view_render(array $views, string $name, array $data = [], bool $strict = true): void
{
  $has_view = isset($views[$name]);
  if (!$has_view && $strict) {
    throw new exception(sprintf("The view '%s' does not exists", $name));
  } elseif ($has_view) {
    $readable = is_file($views[$name]) && is_readable($views[$name]);
    if (!$readable && $strict) {
      throw new exception(sprintf("The view '%s' (%s) is not readable", $name, $views[$name]));
    } elseif ($readable) {
      include $views[$name];
    }
  }
}
