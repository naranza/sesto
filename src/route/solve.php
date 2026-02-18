<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/route/route.php';

function sesto_route_solve(?string $url_path = null, ?string $url_base = null): sesto_route
{
  $route = new sesto_route();
  $route->path = $url_path;
  $route->base = $url_base === null ? '' : $url_base;
  if ($route->base !== '/') {
    $route->relative = preg_replace('#' . $route->base . '#', '', $route->path, 1);
  } else {
    $route->relative = $route->url_path;
  }
  $len = mb_strlen($route->relative);
  $char = $len > 0 ? $route->relative[$len - 1] : '';
  if ('/' == $char) {
    $pinfo = pathinfo($route->relative . 'index');
  } else {
    $pinfo = pathinfo($route->relative);
  }
  $route->dirname = $pinfo['dirname'] ?? '';
  $route->basename = $pinfo['basename'] ?? '';
  $route->filename = $pinfo['filename'] ?? 'index';
  $route->extension = $pinfo['extension'] ?? '';
  return $route;
}
