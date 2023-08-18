<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_locale_auto(): string|false
{
  $env = getenv('cli' != php_sapi_name() ? 'HTTP_ACCEPT_LANGUAGE' : 'LANG');
  return is_string($env) ? locale_accept_from_http($env) : false;
}
