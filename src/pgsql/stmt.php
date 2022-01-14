<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/type/check.php';
require_once SESTO_DIR . '/pgsql/bind.php';
require_once SESTO_DIR . '/pgsql/query.php';
require_once SESTO_DIR . '/pgsql/quote.php';
require_once SESTO_DIR . '/sql/pgsql_prepare.php';
require_once SESTO_DIR . '/sql/pgsql_execute.php';
require_once SESTO_DIR . '/sql/pgsql_deallocate.php';
require_once SESTO_DIR . '/sql/pgsql_is_prepared.php';

final class sesto_pgsql_stmt
{

  private $link;
  private $name;
  private $bind;

  public function __construct($link, string $name)
  {
    $error = sesto_type_check($link, 'pgsql link');
    if ('' !== $error) {
      throw new exception($error, 1000);
    }
    $this->link = $link;
    $this->name = $name;
    $this->bind = new sesto_pgsql_bind();
  }

  public function bind(int $index, $value, string $type)
  {
    $this->bind->set($index, $value, $type);
  }

  public function prepare(string $sql)
  {
    return sesto_pgsql_query(
      $this->link,
      sesto_sql_pgsql_prepare($this->name, $sql, $this->bind->types()));
  }

  public function execute()
  {
    return sesto_pgsql_query(
      $this->link,
      sesto_sql_pgsql_execute($this->name, $this->bind->values()));
  }

  public function deallocate(): bool
  {
    return false !== sesto_pgsql_query(
      $this->link,
      sesto_sql_pgsql_deallocate($this->name));
  }

  public function is_prepared(): bool
  {
    return pg_num_rows(sesto_pgsql_query(
      $this->link,
      sesto_sql_pgsql_is_prepared(sesto_pgsql_quote($this->link, $this->name)))
    ) > 0;
  }

}

