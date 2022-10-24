<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_session_validation_write(string $key, array $errors = null): void
{
  $_SESSION['sesto_validation'][$key] = $errors;
}
