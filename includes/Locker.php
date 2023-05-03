<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 17.03.2017
 * Time: 12:09
 *
 * Notes: Contains the Locker class
 */

use stdClass;

/**
 * Class Locker
 *
 * @package Jahn\DHL
 */
class Locker extends Consignee {
	/**
	 * Contains the Post-Number
	 *
	 * Min-Len: 1
	 * Max-Len: 10
	 *
	 * @var string $postNumber - Post-Number
	 */
	private $postNumber = '';

	/**
	 * Contains the Post-Number
	 *
	 * Min-Len: 1
	 * Max-Len: 10
	 *
	 * @var string $name - Post-Number
	 */
	private $name = '';
	/**
	 * Contains the Pack-Station-Number
	 *
	 * Min-Len: 3
	 * Max-Len: 3
	 *
	 * @var string $lockerID - Pack-Station-Number
	 */
	private $lockerID = '';

	/**
	 * Get the Post-Number
	 *
	 * @return string - Post-Number
	 */
	public function getPostNumber() {
		return $this->postNumber;
	}

	/**
	 * Set the Post-Number
	 *
	 * @param string $postNumber - Post-Number
	 */
	public function setPostNumber($postNumber) {
		$this->postNumber = $postNumber;
	}

	/**
	 * Get the Pack-Station-Number
	 *
	 * @return string - Pack-station-Number
	 */
	public function getLockerID() {
		return $this->lockerID;
	}

	/**
	 * Set the Pack-Station-Number
	 *
	 * @param string $lockerID - Pack-Station-Number
	 */
	public function setLockerID($lockerID) {
		$this->lockerID = $lockerID;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
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
		$class->name = $this->getName1();

		$class->postNumber = $this->getPostNumber();
		$class->lockerID = $this->getLockerID();
		$class->postalCode = $this->getPostalCode();
		$class->city = $this->getCity();
		if($this->getState() !== null)
			$class->state = $this->getState();

		if($this->getCountry() !== null)
			$class->country = $this->getCountry();

		return $class;
	}

}
