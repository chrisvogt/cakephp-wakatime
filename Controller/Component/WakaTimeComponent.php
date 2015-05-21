<?php
use GuzzleHttp\Client as Guzzle;
use Mabasic\WakaTime\WakaTime as WakaTime;

App::uses('Component', 'Controller');

if (!class_exists('WakaTime')) {
	App::import('Vendor', 'mabasic/wakatime-php-api/src');
}

class WakaTimeComponent extends Component {

	protected $WakaTime;

/**
 * Constructor
 *
 * @param ComponentCollection $collection The Component collection used on this request.
 * @param array $settings Array of settings to use.
 */
	public function __construct(ComponentCollection $collection, $settings) {
		$this->WakaTime = new WakaTime(new Guzzle);
		$this->WakaTime->setApiKey($settings['api_key']);
		parent::__construct($collection, $settings);
	}

	public function currentUser() {
		return $this->WakaTime->currentUser();
	}

	public function dailySummary($startDate, $endDate, $project = null) {
		return $this->WakaTime->dailySummary($startDate, $endDate, $project = null);
	}

	public function getHoursLoggedFor($startDate, $endDate, $project = null) {
		return $this->WakaTime->getHoursLoggedFor($startDate, $endDate, $project = null);
	}

	public function getHoursLoggedForLast($period, $project = null) {
		return $this->WakaTime->getHoursLoggedForLast($period, $project = null);
	}

	public function getHoursLoggedForToday() {
		return $this->WakaTime->getHoursLoggedForToday();
	}

	public function getHoursLoggedForYesterday() {
		return $this->WakaTime->getHoursLoggedForYesterday();
	}

	public function getHoursLoggedForLast7Days() {
		return $this->WakaTime->getHoursLoggedForLast7Days();
	}

	public function getHoursLoggedForLast30Days() {
		return $this->WakaTime->getHoursLoggedForLast30Days();
	}

	public function getHoursLoggedForLastMonth() {
		return $this->WakaTime->getHoursLoggedForLastMonth();
	}

}
