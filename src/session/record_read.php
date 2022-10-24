<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_session_record_read(string $key): array
{
  return $_SESSION['sesto_record'][$key] ?? [];
}
