<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

//require_once SESTO_DIR . '/session/expire_add.php';

function sesto_session_alert_write(string $key, string $type = null, string $message = null): void
{
  if (null === $type && null === $message) {
    unset($_SESSION['sesto_alert'][$key]);
  } else {
    $_SESSION['sesto_alert'][$key][] = [
      'type' => $type,
      'message' => $message
    ];

  }
//  sesto_session_expire_add('sesto_alert', $key , 'hop', $hop);
}
