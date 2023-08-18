<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_locale_resolve(string $locale): array
{
  return [
    'locale' => $locale,
    'primary_language' => locale_get_primary_language($locale),
    'region' => locale_get_region($locale)];
}
