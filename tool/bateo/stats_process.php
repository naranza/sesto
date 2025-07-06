<?php

/* =============================================================================
 * Naranza Bateo - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function bateo_stats_process(): array
{
  return [
    'found' => 0,
    'processed' => 0,
    'passed' => 0,
    'failed' => 0,
    'erred' => 0];
}
