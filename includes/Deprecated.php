<?php
/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 06.02.2020
 * Time: 22:41
 *
 * Notes: Contains all deprecated information & methods
 */

namespace Jahn\DHL;

use Exception;

/**
 * Class Deprecated
 *
 * @package Jahn\DHL
 */
class Deprecated {

	/**
	 * Deprecated constructor
	 */
	public function __construct() {
		// VOID
	}

	/**
	 * Deprecated clone
	 */
	public function __clone() {
		// VOID
	}

	/**
	 * Notes about a deprecated method
	 *
	 * @param string $method - Method-Name
	 * @param string|null $class - Class-Name or null for none
	 * @param string $message - Optional Message
	 */
	private static function methodIsDeprecated(string $method, $class = null, $message = '') {
		trigger_error(trim('[DHL-PHP-SDK]: Method ' . (($class) ? $class . '->' : '') . $method . ' is deprecated. ' . $message), E_USER_DEPRECATED);
		error_log(trim('[DHL-PHP-SDK]: Method ' . (($class) ? $class . '->' : '') . $method . ' is deprecated. ' . $message), E_USER_DEPRECATED);
	}

	/**
	 * Notes about a deprecated method, also throws an Exception
	 *
	 * @param string $method - Method-Name
	 * @param string|null $class - Class-Name or null for none
	 * @param string $message - Optional Message
	 * @throws Exception - Deprecated Exception
	 */
	private static function methodIsDeprecatedWithException(string $method, $class = null, $message = '') {
		self::methodIsDeprecated($method, $class, $message);

		throw new Exception(trim('[DHL-PHP-SDK]: Method ' . (($class) ? $class . '->' : '') . $method . ' is deprecated. ' . $message));
	}
}
