<?php
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");
class clicnat_confTest extends PHPUnit_Framework_TestCase {
	public function testConf() {
		$c = conf();
		$this->assertTrue(is_object($c));
		$this->assertObjectHasAttribute('pdo_pgsql_dsn', $c);
	}

}
