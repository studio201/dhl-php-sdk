<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 15.09.2016
 * Time: 15:23
 *
 * Notes: Contains the DHL-Address Class
 */

use stdClass;

/**
 * Class Address
 *
 * @package Jahn\DHL
 */
abstract class Address {
	/**
	 * Contains the Street Name (without number)
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 * Max-Len: 50 (since 3.0)
	 *
	 * @var string $addressStreet - Street Name (without number)
	 */
	private $addressStreet = '';

	/**
	 * Contains the Street Number (may with extra stuff like a/b/c/d etc)
	 *
	 * Min-Len: -
	 * Max-Len: 5
	 * Max-Len: 10 (since 3.0)
	 *
	 * @var string $addressHouse - Street Number (may with extra stuff like a/b/c/d etc)
	 */
	private $addressHouse = '';

	/**
	 * Contains other Info about the Address like if its hard to find or where it is exactly located
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $additionalAddressInformation1 - Address-Addition | null for none
	 */
	private $additionalAddressInformation1 = null;

	/**
	 * Contains other Info about the Address like if its hard to find or where it is exactly located
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $additionalAddressInformation2 - Address-Addition | null for none
	 */
	private $additionalAddressInformation2 = null;

	/**
	 * Contains other Info about the Address like if its hard to find or where it is exactly located
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $additionalAddressInformation3 - Address-Addition | null for none
	 */
	private $additionalAddressInformation3 = null;

	/**
	 * Contains Optional Dispatching Info
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $dispatchingInfo - Optional Dispatching Info | null for none
	 */
	private $dispatchingInfo = null;

	/**
	 * Contains the ZIP-Code
	 *
	 * Min-Len: -
	 * Max-Len: 10
	 * Max-Len: 17 (since 3.0)
	 *
	 * @var string $zip - ZIP-Code
	 */
	private $postalCode = '';

	/**
	 * Contains the City/Location
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 * Max-Len: 50 (since 3.0)
	 *
	 * @var string $location - Location
	 */
	private $city = '';

	/**
	 * Contains the Country
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 30
	 *
	 * @var string|null $country - Country | null for none
	 */
	private $country = null;

	/**
	 * Contains the Name of the State (Geo-Location)
	 *
	 * Note: Optional
	 * Min-Len: -
	 * Max-Len: 30
	 * Max-Len: 35 (since 3.0)
	 *
	 * @var string|null $state - Name of the State (Geo-Location) | null for none
	 */
	private $state = null;

	/**
	 * Get the Street name
	 *
	 * @return string - Street name
	 */
	public function getAddressStreet() {
		return $this->addressStreet;
	}

	/**
	 * Set the Street name
	 *
	 * @param string $addressStreet - Street name
	 */
	public function setAddressStreet($addressStreet) {
		$this->addressStreet = $addressStreet;
	}

	/**
	 * Get the Street number
	 *
	 * @return string - Street Number
	 */
	public function getAddressHouse() {
		return $this->addressHouse;
	}

	/**
	 * Set the Street number
	 *
	 * @param string $addressHouse - Street Number
	 */
	public function setAddressHouse($addressHouse) {
		$this->addressHouse = $addressHouse;
	}

	/**
	 * Get the Address addition
	 *
	 * @return null|string - Address addition or null for none
	 */
	public function getAdditionalAddressInformation1() {
		return $this->additionalAddressInformation1;
	}

	/**
	 * Get the Address addition
	 *
	 * @return null|string - Address addition or null for none
	 */
	public function getAdditionalAddressInformation2() {
		return $this->additionalAddressInformation2;
	}

	/**
	 * Get the Address addition
	 *
	 * @return null|string - Address addition or null for none
	 */
	public function getAdditionalAddressInformation3() {
		return $this->additionalAddressInformation3;
	}
	/**
	 * Set the Address addition
	 *
	 * @param null|string $additionalAddressInformation1 - Address addition or null for none
	 */
	public function setAdditionalAddressInformation1($additionalAddressInformation1) {
		$this->additionalAddressInformation1 = $additionalAddressInformation1;
	}

	/**
	 * Set the Address addition
	 *
	 * @param null|string $additionalAddressInformation2 - Address addition or null for none
	 */
	public function setAdditionalAddressInformation2($additionalAddressInformation2) {
		$this->additionalAddressInformation2 = $additionalAddressInformation2;
	}

	/**
	 * Set the Address addition
	 *
	 * @param null|string $additionalAddressInformation3 - Address addition or null for none
	 */
	public function setAdditionalAddressInformation3($additionalAddressInformation3) {
		$this->additionalAddressInformation3 = $additionalAddressInformation3;
	}
	/**
	 * Get the Dispatching-Info
	 *
	 * @return null|string - Dispatching-Info or null for none
	 */
	public function getDispatchingInfo() {
		return $this->dispatchingInfo;
	}

	/**
	 * Set the Dispatching-Info
	 *
	 * @param null|string $dispatchingInfo - Dispatching-Info or null for none
	 */
	public function setDispatchingInfo($dispatchingInfo) {
		$this->dispatchingInfo = $dispatchingInfo;
	}

	/**
	 * Get the ZIP
	 *
	 * @return string - ZIP
	 */
	public function getPostalCode() {
		return $this->postalCode;
	}

	/**
	 * Set the ZIP
	 *
	 * @return string - ZIP
	 */
	public function setPostalCode($postalCode) {
		return $this->postalCode=$postalCode;
	}
	/**
	 * Get the Location
	 *
	 * @return string - Location
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Set the Location
	 *
	 * @param string $city - Location
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Get the Country
	 *
	 * @return string|null - Country or null for none
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Set the Country
	 *
	 * @param string|null $country - Country or null for none
	 */
	public final function setCountry($country) {
		if($country !== null)
			$this->country = mb_strtoupper($country);
		else
			$this->country = null;
	}


	/**
	 * Get the State (Geo-Location)
	 *
	 * @return null|string - State (Geo-Location) or null for none
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Set the State (Geo-Location)
	 *
	 * @param null|string $state - State (Geo-Location) or null for none
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * Returns the Origin Class
	 *
	 * @return StdClass - Origin Class
	 * @since 3.0
	 */
	protected function getOriginClass_v3() {
		$class = new StdClass;

		if($this->getCountry() !== null)
			$class->country = $this->getCountry();

		if($this->getState() !== null)
			$class->state = $this->getState();

		return $class;
	}
}
