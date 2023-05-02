<?php
/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 09.06.2019
 * Time: 16:05
 *
 * Notes: Contains the class for the Label-Format
 */

namespace Jahn\DHL;

use stdClass;

/**
 * Class Details
 *
 * @package Jahn\DHL
 * @since 3.0
 */
class Details {
	/**
	 * DHL uses sometimes strings instead of int values for true/false, these are set here
	 */
	/**
	 * Contains the Label-Format
	 *
	 * Note: Optional
	 *
	 *
	 * @var string|null $uom - Label-Format (null uses default)
	 */
	private $uom = "kg";

	/**
	 * Contains the Return-Label-Format
	 *
	 *
	 * @var string|null $value - Return-Label-Format (null uses default)
	 */
	private $value = 1;

	/**
	 * Contains the Return-Label-Format
	 *
	 *
	 * @var string|null $dim - Return-Label-Format (null uses default)
	 */
	private $dim = null;

	/**
	 *
	 * @var string|null
	 */
	private $height = null;

	/**
	 *
	 * @var string|null
	 */
	private $width = null;

	/**
	 *
	 * @var string|null
	 */
	private $length = null;

	/**
	 *
	 * @var float|null
	 */
	private $weight = null;

	/**
	 * @return string|null
	 */
	public function getWeightValue(): ?string
	{
		return $this->value;
	}

	/**
	 * @param string|null $value
	 */
	public function setWeightValue(?string $value): void
	{
		$this->value = $value;
	}

	/**
	 * @return string|null
	 */
	public function getWeightUom(): ?string
	{
		return $this->uom;
	}

	/**
	 * @param string|null $uom
	 */
	public function setWeightUom(?string $uom): void
	{
		$this->uom = $uom;
	}


	public function getDimUom(): ?string
	{
		return $this->uom;
	}

	/**
	 * @param string|null $uom
	 */
	public function setDimUom(?string $uom): void
	{
		$this->uom = $uom;
	}

	/**
	 * @return string|null
	 */
	public function getDimHeight(): ?string
	{
		return $this->height;
	}

	/**
	 * @param string|null $height
	 */
	public function setDimHeight(?string $height): void
	{
		$this->height = $height;
	}

	/**
	 * @return string|null
	 */
	public function getDimLength(): ?string
	{
		return $this->length;
	}

	/**
	 * @param string|null $length
	 */
	public function setDimLength(?string $length): void
	{
		$this->length = $length;
	}

	/**
	 * @return string|null
	 */
	public function getDimWidth(): ?string
	{
		return $this->width;
	}

	/**
	 * @param string|null $width
	 */
	public function setDimWidth(?string $width): void
	{
		$this->width = $width;
	}


	public function getClass_V3() {
		$class = new StdClass;
		$class->weight = new StdClass;
		if($this->getWeightUom() !== null)
			$class->weight->uom = $this->getWeightUom();
		if($this->getWeightValue() !== null)
			$class->weight->value = $this->getWeightValue();
		if($this->getDimUom()!== null && $this->getDimHeight()!== null && $this->getDimWidth()!== null && $this->getDimLength()!== null)
			$class->dim = $this->getDim();

		return $class;
	}

	/**
	 * @return stdClass
	 */
	public function getDim()
	{
		$class = new stdclass;
		$class->length = $this->getDimLength();
		$class->width = $this->getDimWidth();
		$class->height = $this->getDimHeight();
		$class->uom = $this->getDimUom();
		return $class;
	}

	/**
	 * @param string|null $dim
	 */
	public function setDim(?string $dim): void
	{
		$this->dim = $dim;
	}

	/**
	 * @return string|null
	 */
	public function getWeight(): ?string
	{
		return $this->weight;
	}

	/**
	 * @param string|null $weight
	 */
	public function setWeight(?string $weight): void
	{
		$this->weight = $weight;
	}
}
