<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 28.01.2017
 * Time: 19:41
 *
 * Notes: Contains the ReturnReceiver Class
 */

use stdClass;

/**
 * Class ReturnReceiver
 *
 * @package Jahn\DHL
 */
class ReturnReceiver {

	private $billingNumber = null;
	private $refNo = null;

	/**
	 * Name of the SendPerson (Can be a Company-Name too!)
	 *
	 * Min-Len: -
	 * Max-Len: 50
	 *
	 * @var string $name1 - Name
	 */
	private $name1;

	/**
	 * Name of SendPerson (Part 2)
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 50
	 *
	 * @var string|null $name2 - Name (Part 2) | null for none
	 */
	private $name2 = null;

	/**
	 * Name of SendPerson (Part 3)
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 50
	 *
	 * @var string|null $name3 - Name (Part 3) | null for none
	 */
	private $name3 = null;

	/**
	 * Phone-Number of the SendPerson
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 20
	 *
	 * @var string|null $phone - Phone-Number | null for none
	 */
	private $phone = null;

	/**
	 * E-Mail of the SendPerson
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 70
	 * Max-Len: 50 (since 3.0)
	 *
	 * @var string|null $email - E-Mail-Address | null for none
	 */
	private $email = null;

	/**
	 * Contact Person of the SendPerson (Mostly used in Companies)
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 50
	 *
	 * @var string|null $contactName - Contact Person | null for none
	 */
	private $contactName = null;

	/**
	 * Contains the Street Name (without number)
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 * Max-Len: 50 (since 3.0)
	 *
	 * @var string $streetName - Street Name (without number)
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
	 * Get the Name
	 *
	 * @return string - Name
	 */
	public function getName1() {
		return $this->name1;
	}

	/**
	 * Set the Name
	 *
	 * @param string $name1 - Name
	 */
	public function setName1($name1) {
		$this->name1 = $name1;
	}

	/**
	 * Get the Name2 Field
	 *
	 * @return null|string - Name2 or null if none
	 */
	public function getName2() {
		return $this->name2;
	}

	/**
	 * Set the Name2 Field
	 *
	 * @param null|string $name2 - Name2 or null for none
	 */
	public function setName2($name2) {
		$this->name2 = $name2;
	}

	/**
	 * Get the Name3 Field
	 *
	 * @return null|string - Name3 or null if none
	 */
	public function getName3() {
		return $this->name3;
	}

	/**
	 * Set the Name3 Field
	 *
	 * @param null|string $name3 - Name3 or null for none
	 */
	public function setName3($name3) {
		$this->name3 = $name3;
	}

	/**
	 * Get the Phone
	 *
	 * @return null|string - Phone or null if none
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Set the Phone
	 *
	 * @param null|string $phone - Phone or null for none
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Get the E-Mail
	 *
	 * @return null|string - E-Mail or null if none
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set the E-Mail
	 *
	 * @param null|string $email - E-Mail or null for none
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Get the Contact-Person
	 *
	 * @return null|string - Contact-Person or null if none
	 */
	public function getContactName() {
		return $this->contactName;
	}

	/**
	 * Set the Contact-Person
	 *
	 * @param null|string $contactName - Contact-Person or null for none
	 */
	public function setContactName($contactName) {
		$this->contactName = $contactName;
	}

	/**
	 * @return null
	 */
	public function getBillingNumber()
	{
		return $this->billingNumber;
	}

	/**
	 * @param null $billingNumber
	 */
	public function setBillingNumber($billingNumber): void
	{
		$this->billingNumber = $billingNumber;
	}

	/**
	 * @return null
	 */
	public function getRefNo()
	{
		return $this->refNo;
	}

	/**
	 * @param null $refNo
	 */
	public function setRefNo($refNo): void
	{
		$this->refNo = $refNo;
	}

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
	 * @param string $postalCode - ZIP
	 */
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
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
	public function setCountry($country) {
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
	 * Returns a Class for the DHL-SendPerson
	 *
	 * @return StdClass - DHL-SendPerson-class
	 * @since 3.0
	 */
	public function getClass_v3(): stdClass
	{

		$class = new StdClass;

		$class->billingNumber = $this->getBillingNumber();

		if($this->getRefNo()!== null)
			$class->refNo = $this->getRefNo();

		$class->returnAddress = new stdclass;
		// Name
		$class->returnAddress->name1 = $this->getName1();
		if($this->getName2() !== null)
			$class->returnAddress->name2 = $this->getName2();
		if($this->getName3() !== null)
			$class->returnAddress->name3 = $this->getName3();

		// Address
		if($this->getDispatchingInfo() !== null)
			$class->returnAddress->dispatchingInformation = $this->getDispatchingInfo();
		$class->returnAddress->addressStreet = $this->getAddressStreet();
		$class->returnAddress->addressHouse = $this->getAddressHouse();
		if($this->getAdditionalAddressInformation1() !== null)
			$class->returnAddress->additionalAddressInformation1 = $this->getAdditionalAddressInformation1();
		if($this->getAdditionalAddressInformation2() !== null)
			$class->returnAddress->additionalAddressInformation2 = $this->getAdditionalAddressInformation2();
		if($this->getAdditionalAddressInformation3() !== null)
			$class->returnAddress->additionalAddressInformation3 = $this->getAdditionalAddressInformation3();
		$class->returnAddress->postalCode = $this->getPostalCode();
		$class->returnAddress->city = $this->getCity();
		if($this->getState() !== null)
			$class->returnAddress->state = $this->getState();
		if($this->getCountry() !== null)
			$class->returnAddress->country = $this->getCountry();

		if($this->getContactName() !== null)
			$class->returnAddress->contactName = $this->getContactName();
		if($this->getPhone() !== null)
			$class->returnAddress->phone = $this->getPhone();
		if($this->getEmail() !== null)
			$class->returnAddress->email = $this->getEmail();

		return $class;
	}

}
