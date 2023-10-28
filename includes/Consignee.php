<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 28.01.2017
 * Time: 19:17
 *
 * Notes: Contains the Receiver class
 */

use stdClass;


/**
 * Class Receiver
 *
 * @package Jahn\DHL
 */
class Consignee extends SendPerson {

	/**
	 * Contains the locker
	 *
	 * Min-Len: 1
	 * Max-Len: 10
	 *
	 * @var Locker $locker - locker
	 */
	private  $locker;

	/**
	 * @return Locker|null
	 */
	public function getLocker(): ?Locker
	{
		return $this->locker;
	}

	/**
	 * @param Locker|null $locker
	 */
	public function setLocker(?Locker $locker): void
	{
		$this->locker = $locker;
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

		$class->name1 = $this->getName1();
		if($this->getName2() !== null)
			$class->name2 = $this->getName2();
		if($this->getName3() !== null)
			$class->name3 = $this->getName3();
		if($this->getDispatchingInfo() !== null)
			$class->dispatchingInformation = $this->getDispatchingInfo();
		$class->addressStreet = $this->getAddressStreet();
		$class->addressHouse = $this->getAddressHouse();
		if($this->getadditionalAddressInformation1() !== null)
			$class->additionalAddressInformation1 = $this->getAdditionalAddressInformation1();
		if($this->getadditionalAddressInformation2() !== null)
			$class->additionalAddressInformation2 = $this->getAdditionalAddressInformation2();
		if($this->getadditionalAddressInformation3() !== null)
			$class->additionalAddressInformation3 = $this->getAdditionalAddressInformation3();
		$class->postalCode = $this->getPostalCode();
		$class->city = $this->getCity();
		if($this->getState() !== null)
			$class->state = $this->getState();
		if($this->getCountry() !== null)
			$class->country = $this->getCountry();

		return $class;
	}


}
