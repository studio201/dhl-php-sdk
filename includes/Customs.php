<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 26.01.2017
 * Time: 21:05
 *
 * Notes: Contains the CustomDetails Class
 */

use Exception;
use stdClass;

/**
 * Class CustomDetails
 *
 * @package Jahn\DHL
 */
class Customs {
	/**
	 * Constants for Export-Type
	 */
	const EXPORT_TYPE_OTHER = 'OTHER';
	const EXPORT_TYPE_PRESENT = 'PRESENT';
	const EXPORT_TYPE_COMMERCIAL_SAMPLE = 'COMMERCIAL_SAMPLE';
	const EXPORT_TYPE_DOCUMENT = 'DOCUMENT';
	const EXPORT_TYPE_RETURN_OF_GOODS = 'RETURN_OF_GOODS';
	const EXPORT_TYPE_COMMERCIAL_GOODS = 'COMMERCIAL_GOODS';
	/**
	 * Constants for Terms of Trade
	 */
	const TERMS_OF_TRADE_DDP = 'DDP';
	const TERMS_OF_TRADE_DXV = 'DXV';
	const TERMS_OF_TRADE_DDU = 'DAP';
	const TERMS_OF_TRADE_DDX = 'DDX';

	/**
	 * In case invoice has a number, client app can provide it in this field.
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $invoiceNo - Invoice-Number or null for none
	 */
	private $invoiceNo = null;

	/**
	 * Export type
	 * (depends on chosen product -> only mandatory for international, non EU shipments).
	 *
	 * Note: Required! (Even if just mandatory for international shipments)
	 *
	 * Possible values:
	 * OTHER
	 * PRESENT
	 * COMMERCIAL_SAMPLE
	 * DOCUMENT
	 * RETURN_OF_GOODS
	 *
	 * @var string $exportType - Export-Type (Can assigned with CustomDetails::EXPORT_TYPE_{TYPE} or as value)
	 */
	private $exportType;

	/**
	 * Description for Export-Type (especially needed if Export-Type is OTHER)
	 *
	 * Note: Optional|Required if "EXPORT_TYPE" is OTHER
	 *
	 * Min-Len: 1
	 * Max-Len: 256
	 *
	 * @var string|null $exportDescription - Export-Description or null for none
	 */
	private $exportDescription = null;

	/**
	 * Element provides terms of trades
	 *
	 * Note: Optional
	 *
	 * Min-Len: 3
	 * Max-Len: 3
	 *
	 * Possible values:
	 * DDP - Delivery Duty Paid
	 * DXV - Delivery duty paid (excl. VAT )
	 * DDU - DDU - Delivery Duty Paid
	 * DDX - Delivery duty paid (excl. Duties, taxes and VAT)
	 *
	 * @var string|null $shippingConditions - Terms of trades (Can assigned with CustomDetails::TERMS_OF_TRADE_{TYPE})
	 * 									or null for none
	 */
	private $shippingConditions = null;

	/**
	 * Permit-Number
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 10
	 *
	 * @var string|int|float|null $permitNumber - Permit number or null for none
	 */
	private $permitNo = null;

	/**
	 * Attestation number
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string| $attestationNo - The attestation number or null for none
	 */
	private $attestationNo = null;

	/**
	 * Is with Electronic Export Notification
	 *
	 * Note: Optional
	 *
	 * @var bool|null $hasElectronicExportNotification - Is with Electronic Export Notification or null for default
	 */
	private $hasElectronicExportNotification = null;

	/**
	 * Additional custom fees to be payed
	 *
	 * Note: Required
	 *
	 * @var float $postalCharges - Additional fee
	 */
	private $postalCharges;

	/**
	 * Place of committal
	 *
	 * Note: Required
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string $officeOfOrigin - Place of committal is a Location
	 */
	private $officeOfOrigin;


	/**
	 * Contains the ExportDocPosition-Class(es)
	 *
	 * Note: Optional
	 *
	 * @var ExportDocPosition|ExportDocPosition[]|null $exportDocPosition - ExportDocPosition-Class or an array with ExportDocPosition-Objects or null if not needed
	 */
	private $items = null;

	/**
	 * Contains the ExportDocPosition-Class(es)
	 *
	 * Note: Optional
	 *
	 * @var ExportDocPosition|ExportDocPosition[]|null $exportDocPosition - ExportDocPosition-Class or an array with ExportDocPosition-Objects or null if not needed
	 */
	private $exportDocPosition = null;

	/**
	 * Get the Invoice-Number
	 *
	 * @return float|int|null|string - Invoice-Number or null if none
	 */
	public function getInvoiceNo() {
		return $this->invoiceNo;
	}

	/**
	 * Set the Invoice-Number
	 *
	 * @param float|int|null|string $invoiceNo - Invoice-Number or null for none
	 */
	public function setInvoiceNo($invoiceNo) {
		$this->invoiceNo = $invoiceNo;
	}

	/**
	 * Get the Export-Type
	 *
	 * @return string - Export-Type
	 */
	public function getExportType() {
		return $this->exportType;
	}

	/**
	 * Set the Export-Type
	 *
	 * @param string $exportType - Export-Type
	 */
	public function setExportType($exportType) {
		$this->exportType = $exportType;
	}

	/**
	 * Get the Export-Type-Description
	 *
	 * @return null|string - Export-Type-Description or null if none
	 */
	public function getExportDescription() {
		return $this->exportDescription;
	}

	/**
	 * Set the Export-Type-Description
	 *
	 * @param null|string $exportDescription - Export-Description or null for none
	 */
	public function setExportDescription($exportDescription) {
		$this->exportDescription = $exportDescription;
	}

	/**
	 * Get the Terms of Trade
	 *
	 * @return null|string - Terms of Trade or null if none
	 */
	public function getShippingConditions() {
		return $this->shippingConditions;
	}

	/**
	 * Set the Terms of Trade
	 *
	 * @param null|string $shippingConditions - Terms of Trade or null for none
	 */
	public function setShippingConditions($shippingConditions) {
		$this->shippingConditions = $shippingConditions;
	}

	/**
	 * Get the Permit-Number
	 *
	 * @return float|int|null|string - Permit-Number or null if none
	 */
	public function getPermitNo() {
		return $this->permitNo;
	}

	/**
	 * Set the Permit-Number
	 *
	 * @param float|int|null|string $permitNo - Permit-Number or null for none
	 */
	public function setPermitNo($permitNo) {
		$this->permitNo = $permitNo;
	}

	/**
	 * Get the Attestation-Number
	 *
	 * @return float|int|null|string - Attestation-Number or null if none
	 */
	public function getAttestationNo() {
		return $this->attestationNo;
	}

	/**
	 * Set the Attestation-Number
	 *
	 * @param float|int|null|string $attestationNo - Attestation-Number or null for none
	 */
	public function setAttestationNo($attestationNo) {
		$this->attestationNo = $attestationNo;
	}

	/**
	 * Get if it is with Electronic Export Notifications
	 *
	 * @return bool|null - Is it has Electronic Export Notifications or null if default
	 */
	public function getHasElectronicExportNotification() {
		return $this->hasElectronicExportNotification;
	}

	/**
	 * Set if it is with Electronic Export Notifications
	 *
	 * @param bool|null $hasElectronicExportNotification - Is it has Electronic Export Notifications or null for default
	 */
	public function setHasElectronicExportNotification($hasElectronicExportNotification) {
		$this->hasElectronicExportNotification = $hasElectronicExportNotification;
	}

	/**
	 * Get the postalCharges
	 *
	 * @return array - postalCharges
	 */
	public function getPostalCharges(): array {
		return array(
			"value" => $this->postalCharges->value,
			"currency" => $this->postalCharges->currency
		);
	}

	/**
	 * Sets the additional Fee
	 *
	 * @param float $postalCharges - postalCharges
	 */
	public function setPostalCharges(float $postalCharges, string $currency): void {
		$this->postalCharges = new stdclass;
		$this->postalCharges->value = $postalCharges;
		$this->postalCharges->currency = mb_strtoupper($currency);
	}

	/**
	 * Get the Place of Committal
	 *
	 * @return string - Place of Committal
	 */
	public function getOfficeOfOrigin() {
		return $this->officeOfOrigin;
	}

	/**
	 * Set the Place of Committal
	 *
	 * @param string $officeOfOrigin - Place of Committal
	 */
	public function setOfficeOfOrigin($officeOfOrigin) {
		$this->officeOfOrigin = $officeOfOrigin;
	}

	/**
	 * Get the ExportDocPosition(s) class(es)
	 *
	 * @return ExportDocPosition|ExportDocPosition[]|null - ExportDocPosition(s) class(es) or null if none
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * Set the ExportDocPosition(s) class(es)
	 *
	 * @param ExportDocPosition|ExportDocPosition[]|null $items - ExportDocPosition(s) class(es) or null for none
	 */
	public function setItems($items) {
		$this->items = $items;
	}

	/**
	 * Get the ExportDocPosition(s) class(es)
	 *
	 * @return ExportDocPosition|ExportDocPosition[]|null - ExportDocPosition(s) class(es) or null if none
	 */
	public function getExportDocPosition() {
		return $this->exportDocPosition;
	}

	/**
	 * Set the ExportDocPosition(s) class(es)
	 *
	 * @param ExportDocPosition|ExportDocPosition[]|null $exportDocPosition - ExportDocPosition(s) class(es) or null for none
	 */
	public function setExportDocPosition($exportDocPosition) {
		$this->exportDocPosition = $exportDocPosition;
	}

	/**
	 * Adds an ExportDocPosition-Object to the current Object
	 *
	 * If the ExportDocPosition was null before, then it will add the entry normal (backwards compatibility)
	 * If the ExportDocPosition was an array before, it just add it to the array
	 * If the ExportDocPosition was just 1 entry before, it will converted to an array with both entries
	 *
	 * @param ExportDocPosition $exportDocPosition - Object to add
	 */
	public function addItem($exportDocPosition) {
			$this->items[] = $exportDocPosition;
	}


	/**
	 * Returns a Class for Export-Document
	 *
	 * @return StdClass - DHL-ExportDocument-Class
	 * @throws Exception - Invalid Data-Exception
	 * @since 2.0
	 */
	public function getClass_V3() {
		$class = new StdClass;

		// Standard-Export-Stuff
		if($this->getInvoiceNo() !== null)
			$class->invoiceNo = $this->getInvoiceNo();

		$class->exportType = $this->getExportType();

		if($this->getExportDescription() !== null)
			$class->exportDescription = $this->getExportDescription();

		if($this->getShippingConditions() !== null)
			$class->shippingConditions = $this->getShippingConditions();

		if($this->getPermitNo() !== null)
			$class->permitNo = $this->getPermitNo();

		if($this->getAttestationNo() !== null)
			$class->attestationNo = $this->getAttestationNo();

		if($this->getHasElectronicExportNotification() !== null)
			$class->hasElectronicExportNotification = $this->getHasElectronicExportNotification();

		$class->postalCharges = $this->getPostalCharges();

		$class->officeOfOrigin = $this->getOfficeOfOrigin();

		// Check if child-class is being used
		if($this->getItems() !== null) {
			// Handle non-arrays... (Backward compatibility)
			if(! is_array($this->getItems())) {
				$class->items = $this->getExportDocPosition()->getExportDocPositionClass_v3();
			} else {
				$pos = $this->getItems();
				foreach($pos as $key => &$exportDoc)
					$class->items[$key] = $exportDoc->getExportDocPositionClass_v3();
			}
		}

		return $class;
	}
}
