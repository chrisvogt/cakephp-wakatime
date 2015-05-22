<?php
/**
 * cakephp-wakatime
 *
 * WakaTime API consumer plugin for CakePHP.
 *
 * Licensed under the MIT license.
 * For full copyright and license information, please see the LICENSE file.
 *
 * @copyright 		(c) 2015 Chris Vogt <mail@chrisvogt.me>
 * @link 					https://github.com/chrisvogt/cakephp-wakatime
 * @license 			http://www.opensource.org/licenses/mit-license.php MIT License
 */
use GuzzleHttp\Client as Guzzle;
use Mabasic\WakaTime\WakaTime as WakaTime;

App::uses('Component', 'Controller');

if (!class_exists('Mabasic\WakaTime\Wakatime')) {
	require_once APP . 'vendor/autoload.php';
}

/**
 * WakaTime Component class
 *
 * Creates a bridge between CakePHP and mabasic/wakatime-php-api.
 *
 * @link https://github.com/chrisvogt/cakephp-wakatime
 * @link https://github.com/mabasic/wakatime-php-api
 */
class WakaTimeComponent extends Component {

/**
 * Holds the WakaTime object
 *
 * @var object
 */
	protected $WakaTime;

/**
 * WakaTime component configuration
 *
 * @var array
 */
	public $settings;

/**
 * Class constructor
 *
 * @param ComponentCollection $collection the component collection for this request
 * @param array $settings passed to the component from the controller
 * @return void
 */
	function __construct(ComponentCollection $collection, $settings = array()) {
		$this->WakaTime = new WakaTime(new Guzzle);
		$this->settings = $settings;
		parent::__construct($collection, $settings);
	}

/**
 * Overrides initialize
 *
 * Overrides applied before the controller’s beforeFilter method.
 *
 * @param Controller $controller
 * @return boolean|void
 */
	public function initialize(Controller $controller) {
		parent::initialize($controller);
		$settings = $this->settings;
		if(isset($settings['api_key'])) {
			$this->WakaTime->setApiKey($settings['api_key']);
		} elseif (Configure::check('wakatime.api_key')) {
			$this->WakaTime->setApiKey(Configure::read('wakatime.api_key'));
		} else {
			throw new InvalidArgumentException('WakaTime API key is required.');
		}
		return true;
	}

	public function setApiKey($api_key) {
		return $this->WakaTime->setApiKey($api_key);
	}

/**
 * currentUser
 *
 * Implements $WakaTime->currentUser().
 *
 * @link https://github.com/mabasic/wakatime-php-api#currentuser
 * @link https://wakatime.com/developers/#users
 * @return array
 */
	public function currentUser() {
		return $this->WakaTime->currentUser();
	}

/**
 * dailySummary
 *
 * Implements $WakaTime->dailySummary().
 *
 * @link https://wakatime.com/developers/#summaries
 * @link https://github.com/mabasic/wakatime-php-api#dailysummary
 * @return array
 */
	public function dailySummary($startDate, $endDate, $project = null) {
		return $this->WakaTime->dailySummary($startDate, $endDate, $project = null);
	}

/**
 * getHoursLoggedFor
 *
 * Implements $WakaTime->getHoursLoggedFor().
 *
 * @link https://github.com/mabasic/wakatime-php-api#gethoursloggedfor
 * @return integer
 */
	public function getHoursLoggedFor($startDate, $endDate, $project = null) {
		return $this->WakaTime->getHoursLoggedFor($startDate, $endDate, $project = null);
	}

	/**
	 * getHoursLoggedForLast
	 *
	 * Implements $WakaTime->getHoursLoggedForLast().
	 *
	 * @link https://github.com/mabasic/wakatime-php-api#gethoursloggedforlast
	 * @return integer
	 */
	public function getHoursLoggedForLast($period, $project = null) {
		return $this->WakaTime->getHoursLoggedForLast($period, $project = null);
	}

	/**
	 * getHoursLoggedForToday
	 *
	 * Implements $WakaTime->getHoursLoggedForToday().
	 *
	 * @link https://github.com/mabasic/wakatime-php-api#gethoursloggedfortoday
	 * @return integer
	 */
	public function getHoursLoggedForToday() {
		return $this->WakaTime->getHoursLoggedForToday();
	}

/**
 * getHoursLoggedForYesterday
 *
* Implements $WakaTime->getHoursLoggedForYesterday().
*
* @link https://github.com/mabasic/wakatime-php-api#gethoursloggedforyesterday
* @return integer
*/
	public function getHoursLoggedForYesterday() {
		return $this->WakaTime->getHoursLoggedForYesterday();
	}

	/**
	 * getHoursLoggedForLast7Days
	 *
	* Implements $WakaTime->getHoursLoggedForLast7Days().
	*
	* @link https://github.com/mabasic/wakatime-php-api#gethoursloggedforlast7days
	* @return integer
	*/
	public function getHoursLoggedForLast7Days() {
		return $this->WakaTime->getHoursLoggedForLast7Days();
	}

	/**
	 * getHoursLoggedForLast7Days
	 *
	* Implements $WakaTime->getHoursLoggedForLast30Days().
	*
	* @link https://github.com/mabasic/wakatime-php-api#gethoursloggedforlast30days
	* @return integer
	*/
	public function getHoursLoggedForLast30Days() {
		return $this->WakaTime->getHoursLoggedForLast30Days();
	}

	/**
	 * getHoursLoggedForLastMonth
	 *
	* Implements $WakaTime->getHoursLoggedForLastMonth().
	*
	* @link https://github.com/mabasic/wakatime-php-api#gethoursloggedforlastmonth
	* @return integer
	*/
	public function getHoursLoggedForLastMonth() {
		return $this->WakaTime->getHoursLoggedForLastMonth();
	}
}
