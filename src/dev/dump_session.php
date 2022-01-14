<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - sesto.dev
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/dev/dump.php';

function sesto_dump_session(bool $return = false): string
{
  $out = '';
  if (session_id() == '') {
    $out .= sesto_dump('Session not started', __FUNCTION__, true);
  } else {
    $out .= sesto_dump(session_id(), 'Session id', true);
    $out .= sesto_dump(session_name(), 'Session name', true);
    $out .= sesto_dump(session_get_cookie_params(), 'Cookie parameters', true);
    $out .= sesto_dump($_SESSION, 'Session-content', true);
  }
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}

