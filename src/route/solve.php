<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/route/route.php';
require_once SESTO_DIR . '/url/base.php';
require_once SESTO_DIR . '/url/path.php';
require_once SESTO_DIR . '/url/relative.php';

function sesto_route_solve(string $url_base = null, string $url_path = null): sesto_route
{
  $route = new sesto_route();
  $route->url_base = null === $url_base ? sesto_url_base() : $url_base;
  $route->url_path = null === $url_path ? sesto_url_path() : $url_path;
  $route->url_relative = sesto_url_relative($route->url_path, $route->url_base);
  $len = mb_strlen($route->url_relative);
  $char = $len > 0 ? $route->url_relative[$len - 1] : '';
  if ('/' == $char) {
    $pinfo = pathinfo($route->url_relative . 'index');
  } else {
    $pinfo = pathinfo($route->url_relative);
  }
  $route->dirname = $pinfo['dirname'] ?? '';
  $route->basename = $pinfo['basename'] ?? '';
  $route->filename = $pinfo['filename'] ?? 'index';
  $route->extension = $pinfo['extension'] ?? '';
  if ('/' === $route->dirname) {
    $route->id = '/' . $route->filename;
  } else {
    $route->id = $route->dirname . '/' . $route->filename;
  }

  return $route;
}
