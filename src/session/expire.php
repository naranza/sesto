<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_session_expire(): void
{
  foreach ($_SESSION['sesto_expire'] ?? [] as $id => $expire) {
    $expired = false;
    if ('time' === $expire['type']) {
      /* Expire namespace by time */
      if (($expire['value'] > 0) && (time() > $expire['value'])) {
        $expired = true;
      }
    } elseif ('hop' === $expire['type']) {
      /* Expire namespace by hop */
      $_SESSION['sesto_expire'][$id]['value']--;
      if ($_SESSION['sesto_expire'][$id]['value'] <= 0) {
        $expired = true;
      }
    }
    if ($expired) {
      if (null === $expire['key']) {
        unset($_SESSION[$expire['namespace']]);
        $del_expire = empty($_SESSION[$expire['namespace']]);
      } else {
        unset($_SESSION[$expire['namespace']][$expire['key']]);
        $del_expire = empty($_SESSION[$expire['namespace']][$expire['key']]);
      }
      /* delete expire record */
      if ($del_expire) {
        unset($_SESSION['sesto_expire'][$id]);
      }
    }
  }
}
