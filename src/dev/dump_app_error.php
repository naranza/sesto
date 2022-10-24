<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/dev/dump.php';

function sesto_dump_app_error(throwable $throwable, array $args = []): string
{
  if (ob_get_length() > 0) {
    @ob_clean();
    @ob_end_clean();
  }
  return sesto_dump(['throwable' => $throwable, 'args' => $args]);
}
