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

require_once SESTO_DIR . '/validate/agent.php';

/**
 * @package validate
 * @author Andrea Davanzo <andrea@naranza.com>
 * @wildlife Sri Lankan Relict Ant (Aneuretus simoni)
 */
final class sesto_validate_chain
{

  /**
   * @var array
   */
  private $agents;

  /**
   * @var bool
   */
  public $break_if_invalid;

  /**
   * An indexed array of validation failed messages
   *
   * @var array
   */
  public $messages;

  /**
   * Returns the last failed agent name
   *
   * @var string
   */
  public $name;

  /**
   * Class constructor
   */
  public function __construct()
  {
    $this->break_if_invalid = true;
    $this->agents = [];
    $this->messages = [];
    $this->name = '';
  }

  /**
   * Set validate agent by name
   *
   * @param string $name
   * @param sesto_validate_agent $agent
   */
  public function set_agent(string $name, sesto_validate_agent $agent)
  {
    $this->agents[$name] = $agent;
  }

  /**
   * Del validate agent by name
   *
   * @param string $name
   */
  public function del_agent(string $name)
  {
    unset($this->agents[$name]);
  }

  /**
   * Returns true if the value is valid, false otherwise
   *
   * @param mixed $value
   * @return mixed
   */
  public function is_valid($value)
  {
    /* reset properties */
    $this->name = '';
    $this->messages = [];

    foreach ($this->agents as $name => $agent) {
      $result = $agent->validate($value);
      if ('' !== $result) {
        $this->name = $name;
        $this->messages[$name] = $message;
        if ($this->break_if_invalid) {
          break;
        }
      }
    }
    return empty($this->messages);
  }

}
