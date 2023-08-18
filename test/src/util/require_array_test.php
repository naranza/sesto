<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

use bateo_test as test;

class bateo_testcase
{

  public function setup()
  {
    require_once SESTO_DIR . '/util/require_array.php';
  }

  public function t_require_once_two_files(test $t)
  {
    $require1 = SESTO_TEST_DATA_DIR . '/util/require1.php';
    $require2 = SESTO_TEST_DATA_DIR . '/util/require2.php';
    sesto_require_array([$require1, $require2]);

    $included_files = get_included_files();
    $t->pass_if(
      in_array($require1, $included_files) && in_array($require1, $included_files),
      '$require1 or $require2 not included'
    );
  }

  public function t_require_two_files(test $t)
  {
    $require3 = SESTO_TEST_DATA_DIR . '/util/require3.php';
    $require4 = SESTO_TEST_DATA_DIR . '/util/require4.php';
    sesto_require_array([$require3, $require4], false);

    $included_files = get_included_files();
    $t->pass_if(
      in_array($require3, $included_files) && in_array($require4, $included_files),
      '$require3 or $require4 not included'
    );
  }

  public function t_require_fails(test $t)
  {
    /* here we have an error because Constant require1 is already defined */
    $t->wie = new ErrorException();
    $require1 = SESTO_TEST_DATA_DIR . '/util/require1.php';
    $require2 = SESTO_TEST_DATA_DIR . '/util/require2.php';
    sesto_require_array([$require1, $require2], false);
  }
}
