<?php
/**
 * WakaTime unit test class
 *
 * Contains all WakaTime plugin test cases.
 */
class AllWakaTimeTest extends CakeTestCase {

/**
 * Define tests for this suite
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All WakaTime tests');

		$path = CakePlugin::path('WakaTime') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}
}
