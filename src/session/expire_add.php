<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_session_expire_add(string $namespace, string $key = null, string $type = 'hop', int $value = 1): void
{
  $_SESSION['sesto_expire'][] = [
    'namespace' => $namespace,
    'key' => $key,
    'type' => $type,
    'value' => $value
  ];
}
