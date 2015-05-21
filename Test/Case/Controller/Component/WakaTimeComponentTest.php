<?php
use \GuzzleHttp\Client as Guzzle;
use \Mabasic\WakaTime\WakaTime as WakaTime;

App::uses('Component', 'Controller');
App::uses('WakaTimeComponent', 'WakaTime.Controller/Component');

/**
 * WakaTime Component test cases
 *
 * Test cases for the WakaTime CakePHP component.
 */
class WakaTimeComponentTest extends CakeTestCase {

/**
 * Holds the WakaTime object
 *
 * @var object
 */
	protected $WakaTime;

/**
 * Identifies a project to test against
 *
 * @var string
 */
	protected $project = '';

/**
 * setUp method
 *
 * Setup the test case, backup the static object values so they can be restored.
 *
 * @link http://api.cakephp.org/2.1/class-CakeTestCase.html#_setUp
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->WakaTime = new WakaTime(new Guzzle);
		$this->init();
		$this->project = 'cake-box';
	}

/**
 * Initialize the configuration
 *
 * Priority: env(WAKATIME_API_KEY) > config('wakatime.api_key')
 * @throws InvalidArgumentException if no WakaTime API key is detected.
 * @see WakaTimeComponent::initialize()
 * @return void
 */
	public function init() {
		if (getenv('WAKATIME_API_KEY')) {
			$this->WakaTime->setApiKey(getenv('WAKATIME_API_KEY'));
		} elseif (Configure::check('wakatime.api_key')) {
			$this->WakaTime->setApiKey(Configure::read('wakatime.api_key'));
		} else {
			throw new InvalidArgumentException('WakaTime config file required for tests.');
		}
	}

/**
 * Tests that a WakaTime object has successfully loaded.
 *
 * @return void
 */
	public function testWakaTimeIsLoaded() {
		$this->assertNotNull($this->WakaTime);
	}

/**
 * Validates the $WakaTime object's type.
 *
 * @return void
 */
	public function testWakaTimeObjectType() {
		$this->assertInstanceOf("Mabasic\WakaTime\WakaTime", $this->WakaTime);
	}

/**
 * Verifies that passing an invalid API key results in a failure.
 *
 * @expectedException GuzzleHttp\Exception\RequestException
 * @return void
 */
	public function testInvalidApiKeyFails() {
		$this->setExpectedException('GuzzleHttp\Exception\RequestException');
		$this->WakaTime->setApiKey('DOGE');
		$request = $this->WakaTime->currentUser();
	}

/**
 * Verify currentUser() responds with an array.
 *
 * @return void
 */
	public function testCurrentUserReturnsArray() {
		$this->assertInternalType('array', $this->WakaTime->currentUser());
	}

/**
 * Verify dailySummary() responds with an array.
 *
 * @return void
 */
	public function testDailySummaryReturnsInt() {
		$hours = $this->WakaTime->dailySummary(date('m/d/Y', strtotime('-7 days')), date('m/d/Y'));
		$this->assertInternalType('array', $hours);
	}

/**
 * Verify getHoursLoggedForToday() responds with an integer.
 *
 * @return void
 */
	public function testGetHoursLoggedForTodayReturnsInt() {
		$hours = $this->WakaTime->getHoursLoggedForToday();
		$this->assertInternalType('int', $hours);
	}

/**
 * Verify getHoursLoggedForYesterday() responds with an integer.
 *
 * @return void
 */
	public function testGetHoursLoggedForYesterdayReturnsInt() {
		$hours = $this->WakaTime->getHoursLoggedForYesterday();
		$this->assertInternalType('int', $hours);
	}

/**
 * Verify getHoursLoggedForLast7Days() responds with an integer.
 *
 * @return void
 */
	public function testGetHoursLoggedForLast7Days() {
		$hours = $this->WakaTime->getHoursLoggedForLast7Days();
		$this->assertInternalType('int', $hours);
	}

/**
 * Verify getHoursLoggedForLast30Days() responds with an integer.
 *
 * @return void
 */
	public function testGetHoursLoggedForLast30Days() {
		$hours = $this->WakaTime->getHoursLoggedForLast30Days();
		$this->assertInternalType('int', $hours);
	}

/**
 * Verify getHoursLoggedForLastMonth() responds with an integer.
 *
 * @return void
 */
	public function getHoursLoggedForLastMonth() {
		$hours = $this->WakaTime->getHoursLoggedForLastMonth();
		$this->assertInternalType('int', $hours);
	}
}
