<?php

/* =============================================================================
 * This file is part of Sesto by Naranza <http://naranza.com>
 *
 * Copyright (c) 2009-2018 Andrea Davanzo <andrea@naranza.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

/**
 * @author Andrea Davanzo <andrea@naranza.com>
 * @wildlife
 */
final class sesto_db_pgsql_connector
{

  /**
   * @var sesto_db_driver
   */
  public $driver;

  /**
   * Class constructor
   *
   * @param array $config
   * @throws exception
   */
  public function __construct(string $driver, array $config)
  {
    if ('pgsql' === $driver) {
      require_once SESTO_DIR . '/db/pgsql_driver.php';
      $this->driver = new sesto_db_pgsql_driver($config);
    } else {
      throw new exception('Unknown driver');
    }

    if (false === $this->driver->connect($config)) {
      throw new exception('Unable to connect');
    }
  }

  /**
   * Closes a database connection
   *
   * @return Returns true on success or false on failure.
   */
  public function close(): bool
  {
    if (!$this->driver->connected()) {
      $result = true;
    } else {
      $result = $this->driver->close();
    }
    return $result;
  }

  /**
   * Execute a query
   *
   * @param string $query
   * @return mixed A sesto_db_result on success or false on failure
   * @throws exception
   */
  public function query(string $query)
  {
    if (!$this->driver->connected()) {
      throw new exception('Database not connected');
    } elseif ('' === $query) {
      throw new exception('Empty query');
    } else {
      return $this->driver->query($query);
    }
  }

}
