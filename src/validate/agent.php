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
 * @package validate
 * @author Andrea Davanzo <andrea@naranza.com>
 * @wildlife European Mink (Mustela lutreola)
 */
interface sesto_validate_agent
{

  /**
   * Returns empty string if the value is valid, the error message otherwise
   *
   * @param mixed $value
   * @return mixed
   */
  public function validate($value): string;

}
