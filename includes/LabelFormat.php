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
 * Class LabelFormat
 *
 * @package Jahn\DHL
 * @since 3.0
 */
class LabelFormat {
	/**
	 * DHL uses sometimes strings instead of int values for true/false, these are set here
	 */
	const DHL_FALSE_STR = 'False';
	const DHL_TRUE_STR = 'True';

	/**
	 * DHL-Label-Format Values
	 */
	const FORMAT_DEFAULT = 'GUI';
	const FORMAT_A4 = 'A4';
	const FORMAT_910_300_700 = '910-300-700';
	const FORMAT_910_300_700_OZ = '910-300-700-oZ';
	const FORMAT_910_300_600 = '910-300-600';
	const FORMAT_910_300_610 = '910-300-610';
	const FORMAT_910_300_710 = '910-300-710';

	/**
	 * Contains the Label-Format
	 *
	 * Note: Optional
	 *
	 * Values:
	 * A4
	 * 910-300-700
	 * 910-300-700-oZ
	 * 910-300-600
	 * 910-300-610
	 * 910-300-710
	 *
	 * @var string|null $labelFormat - Label-Format (null uses default)
	 */
	private $labelFormat = '910-300-600';

	/**
	 * Contains the Return-Label-Format
	 *
	 * Note: Optional
	 * Values:
	 * A4
	 * 910-300-700
	 * 910-300-700-oZ
	 * 910-300-600
	 * 910-300-610
	 * 910-300-710
	 *
	 * @var string|null $labelFormatRetoure - Return-Label-Format (null uses default)
	 */
	private $labelFormatRetoure = '910-300-600';

	/**
	 * Contains if Shipment label and return label get printed together
	 *
	 * Note: Optional
	 *
	 * @var string|null $combinedPrinting - Are both labels printed together (null uses default)
	 */
	private $combinedPrinting = true;


	/**
	 * Contains the Sender-Object
	 *
	 * Note: Optional IF ShipperReference is given (Since 3.0)
	 **/
	private $docFormat = 'PDF';

	/**
	 * Contains if how the Label-Response-Type will be
	 *
	 * Note: Optional
	 *
	 * Values:
	 * RESPONSE_TYPE_URL -> Url
	 * RESPONSE_TYPE_B64 -> Base64
	 * RESPONSE_TYPE_XML -> XML (since 3.0)
	 * RESPONSE_TYPE_ZPL2 -> ZPL2 (since 3.0)
	 *
	 * @var string|null $labelResponseType - Label-Response-Type (Can use class constance's) (null uses default - Url|GUI - since 3.0)
	 */
	private $labelResponseType = 'include';



	/**
	 * Get the Label-Format
	 *
	 * @return string|null - Label-Format | null uses default from DHL
	 */
	public function getLabelFormat(): ?string {
		return $this->labelFormat;
	}

	/**
	 * Set the Label-Format
	 *
	 * @param string|null $labelFormat - Label-Format | null uses default from DHL
	 */
	public function setLabelFormat(?string $labelFormat): void {
		$this->labelFormat = $labelFormat;
	}

	/**
	 * Get the Return-Label-Format
	 *
	 * @return string|null - Return-Label-Format | null uses default from DHL
	 */
	public function getLabelFormatRetoure(): ?string {
		return $this->labelFormatRetoure;
	}

	/**
	 * Get the Return-Label-Format
	 *
	 * @param string|null $labelFormatRetoure - Return-Label-Format | null uses default from DHL
	 */
	public function setLabelFormatRetoure(?string $labelFormatRetoure): void {
		$this->labelFormatRetoure = $labelFormatRetoure;
	}

	/**
	 * Get if both labels (label & return label) should printed together
	 *
	 * @return bool|null - Should labels printed together | null uses default from DHL
	 */
	public function getCombinedPrinting(): ?string {
		return $this->combinedPrinting;
	}

	/**
	 * Set if both labels (label & return label) should printed together
	 *
	 * @param bool|null $combinedPrinting - Should labels printed together | null uses default from DHL
	 */
	public function setCombinedPrinting(?string $combinedPrinting): void {
		$this->combinedPrinting = $combinedPrinting;
	}


	/**
	 * @return string
	 */
	public function getDocFormat(): string
	{
		return $this->docFormat;
	}

	/**
	 * @param string $docFormat
	 */
	public function setDocFormat(string $docFormat): void
	{
		$this->docFormat = $docFormat;
	}

	/**
	 * @return string|null
	 */
	public function getLabelResponseType(): ?string
	{
		return $this->labelResponseType;
	}

	/**
	 * @param string|null $labelResponseType
	 */
	public function setLabelResponseType(?string $labelResponseType): void
	{
		$this->labelResponseType = $labelResponseType;
	}

	/**
	 * Get the value for the Label (needs a string)
	 *
	 * @return string|null - DHL-Bool string or null for default
	 */
	public function getCombinedPrintingLabel(): ?string {
		if($this->getCombinedPrinting() === null)
			return null;

		return ($this->getCombinedPrinting()) ? self::DHL_TRUE_STR : self::DHL_FALSE_STR;
	}

	/**
	 * Gets the Label-Format-Class for Version 3
	 *
	 * @param StdClass $classToExtend - Class to extend with this info
	 * @return StdClass - Label-Format-Class
	 * @since 3.0
	 */
	public function addLabelFormatClass_v3($classToExtend) {
		if($this->getLabelFormat() !== null)
			$classToExtend->labelFormat = $this->getLabelFormat();
		if($this->getLabelFormatRetoure() !== null)
			$classToExtend->labelFormatRetoure = $this->getLabelFormatRetoure();
		if($this->getCombinedPrinting() !== null)
			$classToExtend->combinedPrinting = $this->getCombinedPrintingLabel();

		return $classToExtend;
	}
		public function labelFormatClass_v3() {

			$class= new stdclass;
			if($this->getLabelFormat() !== null)
				$class->labelFormat = $this->getLabelFormat();
			if($this->getLabelFormatRetoure() !== null)
				$class->labelFormatRetoure = $this->getLabelFormatRetoure();
			if($this->getCombinedPrinting() !== null)
				$class->combinedPrinting = $this->getCombinedPrintingLabel();

			return $class;
	}

}
