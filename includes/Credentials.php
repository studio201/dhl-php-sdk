<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 15.09.2016
 * Time: 14:26
 *
 * Notes: Contains the Credentials class
 */

/**
 * Class Credentials
 *
 * @package Jahn\DHL
 */
class Credentials {

	// Test-User Value Constants
	/**
	 * DHL Business-API Test-User (Normal)
	 */
	const DHL_BUSINESS_TEST_USER = 'sandy_sandbox';

	/**
	 * DHL Business-API Test-User-Password
	 */
	const DHL_BUSINESS_TEST_USER_PASSWORD = 'pass';

	/**
	 * DHL Business-API Test-EKP
	 */
	const DHL_BUSINESS_TEST_EKP = '3333333333';

	/**
	 * Contains the DHL-Intraship Username
	 *
	 * TEST: Use the Test-User for Business-Shipment - Use in constructor true as 1st param
	 * LIVE: Your DHL-Account same when you Login to the DHL-Business-Customer-Portal
	 * (Same as on this Page: https://www.dhl-geschaeftskundenportal.de/ )
	 *
	 * @var string $user - DHL-Intraship Username
	 */
	private $user = '';

	/**
	 * Contains the DHL-Intraship Password
	 *
	 * TEST: Use the Test-Password for Business-Shipment - Use in constructor true as 1st param
	 * LIVE: Your DHL-Account-Password same when you Login to the DHL-Business-Customer-Portal
	 * (Same as on this Page: https://www.dhl-geschaeftskundenportal.de/ )
	 *
	 * @var string $password - DHL-Intraship Password
	 */
	private $password = '';

	/**
	 * Contains the DHL-Customer ID
	 *
	 * TEST: Use the Test-EKP for Business-Shipment - Use in constructor true as 1st param
	 * LIVE: Your DHL-Customer-Number (At least the first 10 Numbers - Can be more)
	 *
	 * @var string $ekp - DHL-Customer ID
	 */
	private $ekp = '';

	/**
	 * Contains the ApiKey from the developer Account
	 **
	 * @var string $apiKey - App ID from the developer Account
	 */
	private $apiKey = '';

	/**
	 * Contains the App token from the developer Account
	 *
	 * TEST: Your-DHL-Developer-Accounts-Password
	 * (You can create yourself an Account for free here: https://entwickler.dhl.de/group/ep )
	 *
	 * LIVE: Your Applications-Token
	 * (You can get this here: https://entwickler.dhl.de/group/ep/home?myaction=viewFreigabe )
	 *
	 * @var string $apiPassword - Contains the App token from the developer Account
	 */
	private $apiPassword = '';

	/**
	 * Credentials constructor.
	 *
	 * If Test-Modus is true it will set Test-User, Test-Password, Test-EKP for you!
	 *
	 * @param bool|string $sandbox - Use a specific Test-Mode or Live Mode
	 * 					Test-Mode (Normal): Credentials::TEST_NORMAL, 'test', true
	 * 					Test-Mode (Thermo-Printer): Credentials::TEST_THERMO_PRINTER, 'thermo'
	 * 					Live (No-Test-Mode): false - default
	 */
	public function __construct($sandbox = false) {
		if($sandbox) {
			switch($sandbox) {
				case true:
					$this->setUser(self::DHL_BUSINESS_TEST_USER);
				default:
					$this->setUser(self::DHL_BUSINESS_TEST_USER);
			}
			$this->setPassword(self::DHL_BUSINESS_TEST_USER_PASSWORD);
			$this->setEkp(self::DHL_BUSINESS_TEST_EKP);
		}
	}

	/**
	 * Get the DHL-Intraship Username
	 *
	 * @return string - DHL-Intraship Username
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the DHL-Intraship Username in lower case
	 *
	 * @param string $user - DHL-Intraship Username
	 */
	public function setUser($user) {
		$this->user = mb_strtolower($user);
	}

	/**
	 * Get the DHL-Intraship Password
	 *
	 * @return string - DHL-Intraship Password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set the DHL-Intraship Password
	 *
	 * @param string $password - DHL-Intraship Password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * Get the (x first Digits of the) EKP
	 *
	 * @param null|int $len - Max-Chars to get from this String or null for all
	 * @return string - EKP-Number with x Chars
	 */
	public function getEkp($len = null) {
		return mb_substr($this->ekp, 0, $len);
	}

	/**
	 * Set the EKP-Number
	 *
	 * @param string $ekp - EKP-Number
	 */
	public function setEkp($ekp) {
		$this->ekp = $ekp;
	}

	/**
	 * Get the API-User
	 *
	 * @return string - API-User
	 */
	public function getApiKey() {
		return $this->apiKey;
	}

	/**
	 * Set the API-User
	 *
	 * @param string $apiKey - API-User
	 */
	public function setApiKey($apiKey) {
		$this->apiKey = $apiKey;
	}

	/**
	 * Get the API-Password/Key
	 *
	 * @return string - API-Password/Key
	 */
	public function getApiPassword() {
		return $this->apiPassword;
	}


	/**
	 * Set the API-Password/Key
	 *
	 * @param string $apiPassword - API-Password/Key
	 */
	public function setApiPassword($apiPassword) {
		$this->apiPassword = $apiPassword;
	}

}
