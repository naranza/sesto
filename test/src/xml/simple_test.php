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
    require_once SESTO_DIR . '/xml/simple.php';
  }

  public function t_display_true(test $t)
  {
    $t->wie = '<?xml version="1.0" encoding="UTF-8"?>
<root><title><![CDATA[https://naranza.org]]></title></root>
'; /* asXML() returns a \n" */
    $xml = new sesto_xml_simple('<?xml version="1.0" encoding="UTF-8"?><root></root>');
    $xml->addChild('title')->add_cdata('https://naranza.org');
    $t->wig = $xml->asXML();
    $t->pass_if($t->wie === $t->wig);
  }
}
