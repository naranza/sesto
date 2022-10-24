<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_session_expire_add(string $namespace, string $type = 'hop', int $value = 1): array
{
  $_SESSION['sesto_expire'][$namespace] = [$type, $value];
}
