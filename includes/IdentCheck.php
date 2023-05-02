<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 26.01.2017
 * Time: 18:06
 *
 * Notes: Contains all stuff for Ident-Check
 */

use stdClass;

/**
 * Class IdentCheck
 *
 * @package Jahn\DHL
 */
class IdentCheck {
	/**
	 * Contains the Last-Name of the Person
	 *
	 * Min-Len: 0
	 * Max-Len: 255
	 *
	 * @var string $lastName - Last-Name
	 */
	private $lastName;

	/**
	 * Contains the First-Name of the Person
	 *
	 * Min-Len: 0
	 * Max-Len: 255
	 *
	 * @var string $firstName - First-Name
	 */
	private $firstName;

	/**
	 * Contains the Birthday of the Person
	 *
	 * Note: ISO-Date-Format (YYYY-MM-DD)
	 *
	 * Min-Len: 10
	 * Max-Len: 10
	 *
	 * @var string $birthday - Birthday
	 */
	private $birthday;

	/**
	 * Contains the "minimum age of the person for ident check"
	 *
	 * Min-Len: 1
	 * Max-Len: 3
	 *
	 * @var int $minimumAge - "minimum age of the person for ident check"
	 */
	private $minimumAge;

	/**
	 * IdentCheck constructor.
	 *
	 * @param string $lastName - Last-Name
	 * @param string $firstName - First-Name
	 * @param string $birthday - Birthday (Format: YYYY-MM-DD)
	 * @param int $minimumAge - Minimum-Age
	 */
	public function __construct($lastName, $firstName, $birthday, $minimumAge) {
		$this->setLastName($lastName);
		$this->setFirstName($firstName);
		$this->setBirthday($birthday);
		$this->setMinimumAge($minimumAge);
	}

	/**
	 * Get the Last-Name
	 *
	 * @return string - Last-Name
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Set the Last-Name
	 *
	 * @param string $lastName - Last-Name
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Get the First-Name
	 *
	 * @return string - First-Name
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Set the First-Name
	 *
	 * @param string $firstName - First-Name
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Get the Birthday
	 *
	 * @return string - Birthday
	 */
	public function getBirthday() {
		return $this->birthday;
	}

	/**
	 * Set the Birthday
	 *
	 * @param string $birthday - Birthday
	 */
	public function setBirthday($birthday) {
		$this->birthday = $birthday;
	}

	/**
	 * Get the minimum Age
	 *
	 * @return int - Minimum Age
	 */
	public function getMinimumAge() {
		return $this->minimumAge;
	}

	/**
	 * Set the minimum Age
	 *
	 * @param int $minimumAge - Minimum Age
	 */
	public function setMinimumAge($minimumAge) {
		$this->minimumAge = $minimumAge;
	}

	/**
	 * Get the Ident-DHL-Class
	 *
	 * @return StdClass - Ident-DHL-Class
	 * @since 2.0
	 */
	public function getIdentClass_v3() {
		$class = new StdClass;
		$class->firstName = $this->getLastName();
		$class->lastName = $this->getFirstName();
		if($this->getBirthday() !== null)
			$class->birthday = $this->getBirthday();
		$class->minimumAge = $this->getMinimumAge();

		return $class;
	}
}
