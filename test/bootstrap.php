<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

$root_dir = realpath(__DIR__ . '/..');

require $root_dir . '/src/initme.php';

define('SESTO_TEST_DIR', $root_dir . '/test');

const SESTO_TEST_DATA_DIR = SESTO_TEST_DIR . '/data';
const SESTO_TEST_FUNC_DIR = SESTO_TEST_DIR . '/func';
