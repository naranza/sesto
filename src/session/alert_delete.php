<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

//require_once SESTO_DIR . '/session/expire_add.php';

function sesto_session_alert_delete(string $key): void
{
  unset($_SESSION['sesto_alert'][$key]);
}
