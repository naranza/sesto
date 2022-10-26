<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/tld/exists.php';

function sesto_rule_email_tld(string $value): bool
{
  $result = filter_var($value, FILTER_VALIDATE_EMAIL);
  if (false !== $result) {
    $parts = explode('@', $value);
    $domain =  end($parts);
    $parts = explode('.', $domain);
    $result = sesto_tld_exists(end($parts));
  }
  return $result;
}

