<?php
/**
 * WakaTime Plugin bootstrap
 *
 * @license MIT
 * @link https://github.com/chrisvogt/cakephp-wakatime
 */

if (file_exists(APP . 'Config' . DS . 'wakatime.php')) {
	Configure::load('wakatime');
}
