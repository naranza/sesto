<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_rule_only_digits(string $value): bool
{
  return 0 === preg_match('/[^0-9]/', $value);
}
