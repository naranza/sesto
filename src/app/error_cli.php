<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_app_error_cli(throwable $throwable, array $config, array $args = []): void
{
  $extended_info = is_bool($config['sesto_error_extended_info'] ?? null) ?: false;
  echo "\n--- throwable ---\n";
  echo sprintf("%s: %s\n", $throwable->getcode(), $throwable->getmessage());
  if ($extended_info) {
    echo sprintf("\tThrowable: %s\n", print_r($throwable, true));
  }
}
