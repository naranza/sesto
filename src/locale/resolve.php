<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_locale_resolve(string $locale): array
{
  return [
    'locale' => $locale,
    'primary_language' => locale_get_primary_language($locale) ?? '',
    'region' => locale_get_region($locale) ?? ''
  ];
}
