<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_session_record_write(string $key, array $value = null): void
{
  if (null === $value) {
    unset($_SESSION['sesto_record'][$key]);
  } else {
    $_SESSION['sesto_record'][$key] = $value;
  }
}
