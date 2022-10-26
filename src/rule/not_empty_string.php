<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/string/empty.php';

function sesto_rule_not_empty_string(string $value): bool
{
  return true !== sesto_string_empty($value);
}
