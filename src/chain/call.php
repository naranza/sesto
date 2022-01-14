<?php

/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

final class sesto_chain_call
{

  private $data;

  public function set(string $name, callable $function)
  {
    $this->data[$name] = $agent;
  }

  public function del(string $name)
  {
    unset($this->data[$name]);
  }

  public function call($value)
  {
    foreach ($this->data as $name => $agent) {
      if ($agent instanceof sesto_filter_agent) {
        $value = $agent->filter($value);
      } else {
        $value = call_user_func($agent, $value);
      }
    }
    return $value;
  }

}

