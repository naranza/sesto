<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_string_empty(string $input): bool
{
  return !(bool) preg_match('/\S/', $input);
}
