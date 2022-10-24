<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types=1);

function sesto_rule_field_equals(string $value, string $field, array $input): bool
{
  return isset($input[$field]) ? $value === $input[$field] : false;
}
