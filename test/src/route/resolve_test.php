<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

use bateo_test as test;

class bateo_testcase
{

  public function setup()
  {
    require_once SESTO_DIR . '/route/resolve.php';
  }

  public function teardown()
  {

  }

  public function t_test_root(test $t)
  {
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/';
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['QUERY_STRING'] = '';
    $t->wie = [
      'id' => '/index',
      'url_base' => '/',
      'url_path' => '/',
      'url_relative' => '/',
      'dirname' => '/',
      'filename' => 'index',
      'basename' => 'index',
      'extension' => ''
    ];
    $t->wig = sesto_route_resolve();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_root_subdir(test $t)
  {
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/';
    $_SERVER['REQUEST_URI'] = '/doc/app/map.html';
    $_SERVER['QUERY_STRING'] = '';
    $t->wie = [
      'id' => '/doc/app/map',
      'url_base' => '/',
      'url_path' => '/doc/app/map.html',
      'url_relative' => '/doc/app/map.html',
      'dirname' => '/doc/app',
      'filename' => 'map',
      'basename' => 'map.html',
      'extension' => 'html'
    ];
    $t->wig = sesto_route_resolve();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_base_root(test $t)
  {
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/admin/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/';
    $_SERVER['REQUEST_URI'] = '/admin/';
    $_SERVER['QUERY_STRING'] = '';
    $t->wie = [
      'id' => '/index',
      'url_base' => '/admin',
      'url_path' => '/admin/',
      'url_relative' => '/',
      'dirname' => '/',
      'filename' => 'index',
      'basename' => 'index',
      'extension' => ''
    ];
    $t->wig = sesto_route_resolve();
    $t->pass_if($t->wie === $t->wig);
  }

  public function t_test_base_subdir(test $t)
  {
    $_SERVER['SCRIPT_FILENAME'] = '/var/www/admin/bootstrap.php';
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/';
    $_SERVER['REQUEST_URI'] = '/admin/doc/app/map.html';
    $_SERVER['QUERY_STRING'] = '';
    $t->wie = [
      'id' => '/doc/app/map',
      'url_base' => '/admin',
      'url_path' => '/admin/doc/app/map.html',
      'url_relative' => '/doc/app/map.html',
      'dirname' => '/doc/app',
      'filename' => 'map',
      'basename' => 'map.html',
      'extension' => 'html'
      ];
    $t->wig = sesto_route_resolve();
    $t->pass_if($t->wie === $t->wig);
  }
}
