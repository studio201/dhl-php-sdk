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
	 * @var float|null
	 */
	private $height = null;

	/**
	 *
	 * @var float|null
	 */
	private $width = null;

	/**
	 *
	 * @var float|null
	 */
	private $length = null;

	/**
	 *
	 * @var float|null
	 */
	private $weight = null;

	/**
	 * @return float|null
	 */
	public function getWeightValue(): ?float
	{
		return $this->value;
	}

	/**
	 * @param float|null $value
	 */
	public function setWeightValue(?float $value): void
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
		$this->uom = mb_strtolower($uom);
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
		$this->uom = mb_strtolower($uom);
	}

	/**
	 * @return float|null
	 */
	public function getDimHeight(): ?float
	{
		return $this->height;
	}

	/**
	 * @param float|null $height
	 */
	public function setDimHeight(?float $height): void
	{
		$this->height = $height;
	}

	/**
	 * @return float|null
	 */
	public function getDimLength(): ?float
	{
		return $this->length;
	}

	/**
	 * @param float|null $length
	 */
	public function setDimLength(?float $length): void
	{
		$this->length = $length;
	}

	/**
	 * @return float|null
	 */
	public function getDimWidth(): ?float
	{
		return $this->width;
	}

	/**
	 * @param float|null $width
	 */
	public function setDimWidth(?float $width): void
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
	 * @return float|null
	 */
	public function getWeight(): ?float
	{
		return $this->weight;
	}

	/**
	 * @param float|null $weight
	 */
	public function setWeight(?float $weight): void
	{
		$this->weight = $weight;
	}
}
