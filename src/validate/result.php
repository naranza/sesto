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
 * @wildlife 
 */
final class sesto_validate_result
{

  /**
   * @var bool
   */
  public $valid;

  /**
   * @var string
   */
  public $message;

  /**
   * Class constructor
   *
   * @var array $message 
   */
  public function __construct(string $message)
  {
    $this->valid = $message === '' ? true : false;
    $this->message = $message;
  }

}
