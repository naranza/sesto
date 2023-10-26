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
 * @package security
 * @author Andrea Davanzo <andrea@naranza.com>
 * @wildlife
 */
function sesto_is_csrf_valid($session): bool
{
  $is_valid = false;
  if (session_status() == PHP_SESSION_ACTIVE) {
    $is_valid = ($_POST['csrf_token'] ?? 'not_found') === ($_SESSION[$session]['csrf_token'] ?? null);
  }
  return $is_valid;
}
