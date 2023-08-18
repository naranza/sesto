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
    require_once SESTO_DIR . '/memcached/write.php';
    require_once SESTO_DIR . '/memcached/read.php';
    $config = include SESTO_TEST_CONF_DIR . '/memcached.php';
    $this->server = new memcached();
    $this->server->addserver($config['host'], $config['port']);

  }

  public function teardown()
  {

  }

  public function t_write_failed(test $t)
  {
    $found = false;
    $t->wie = null;
    $t->wig = sesto_memcached_read($this->server, uniqid(), $found);
    $t->pass_if(
      $t->wie === $t->wig && false === $found,
      bateo_wix($t->wie, $t->wig));
  }

  public function t_read_found(test $t)
  {
    $key = uniqid();
    $value = uniqid();
    sesto_memcached_write($this->server, $key, $value);
    $found = false;
    $t->wie = $value;
    $t->wig = sesto_memcached_read($this->server, $key, $found);
    $t->pass_if(
      $t->wie === $t->wig && true === $found,
      bateo_wix($t->wie, $t->wig));
  }

  public function t_read_found_null(test $t)
  {
    $key = uniqid();
    $value = null;
    sesto_memcached_write($this->server, $key, $value);
    $found = false;
    $t->wie = $value;
    $t->wig = sesto_memcached_read($this->server, $key, $found);
    $t->pass_if(
      $t->wie === $t->wig && true === $found,
      bateo_wix($t->wie, $t->wig));
  }

  public function t_read_found_false(test $t)
  {
    $key = uniqid();
    $value = false;
    sesto_memcached_write($this->server, $key, $value);
    $found = false;
    $t->wie = $value;
    $t->wig = sesto_memcached_read($this->server, $key, $found);
    $t->pass_if(
      $t->wie === $t->wig && true === $found,
      bateo_wix($t->wie, $t->wig));
  }



}

