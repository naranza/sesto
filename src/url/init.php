<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/url/url.php';

function sesto_url_init(string $site_url, string $request_path = '', ?string $url_base = null): sesto_url {
  $url = new sesto_url();

  $parts = parse_url($site_url);
  $url->scheme = $parts['scheme'] ?? '';
  $url->host = $parts['host'] ?? '';
  $url->port = $parts['port'] ?? ($url->scheme === 'https' ? 443 : 80);
  $url->fullhost = ($url->scheme ? $url->scheme . '://' : '') . $url->host;

  $url->path = $request_path == '' ? parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) : $request_path;
  $url->base = $url_base ?? rtrim($parts['path'] ?? '', '/');

  if ($url->base !== '' && $url->base !== '/' && str_starts_with($url->path, $url->base)) {
    $url->relative = substr($url->path, strlen($url->base));
  } else {
    $url->relative = $url->path;
  }

  if (!str_starts_with($url->relative, '/')) {
    $url->relative = '/' . $url->relative;
  }

  $last_char = $url->relative[-1] ?? '';

  $subject = ($last_char === '/') ? $url->relative . 'index' : $url->relative;
  $pinfo = pathinfo($subject);

  $url->dirname = $pinfo['dirname'];
  $url->basename = $pinfo['basename'];
  $url->filename = $pinfo['filename'];
  $url->extension = $pinfo['extension'] ?? '';

  $url->id = $url->dirname === '/' ? '/' . $url->filename : $url->dirname . '/' . $url->filename;

  return $url;
}
