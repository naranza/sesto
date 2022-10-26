<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_locale_auto(): string
{
  $env = getenv((php_sapi_name() != 'cli') ? 'HTTP_ACCEPT_LANGUAGE' : 'LANG');
  if (is_string($env)) {
    $locale = locale_accept_from_http($env);
  } else {
    $locale = false;
  }
  return (false !== $locale && null !== $locale) ? $locale : '';
}
