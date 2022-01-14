<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/string/is_empty.php';

function sesto_http_redirect(string $url, int $response_code = 303)
{
  if (sesto_string_is_empty($url)) {
    throw new exception('Empty redirect url');
  }
  header("Status: " . $response_code, true);
  header("Location: " . $url, true, $response_code);
}

