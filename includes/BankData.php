<?php

namespace Jahn\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 26.01.2017
 * Time: 20:14
 *
 * Notes: Contains BankData Class
 */

use stdClass;

/**
 * Class BankData
 *
 * @package Jahn\DHL
 */
class BankData {

	/**
	 * Account reference to customer profile
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $accountHolder - Account reference to customer profile | null for none
	 */
	private $accountHolder = null;

	/**
	 * Name of the Bank
	 *
	 * Min-Len: -
	 * Max-Len: 80
	 *
	 * @var string $bankName - Name of the Bank
	 */
	private $bankName = '';

	/**
	 * IBAN of the Account
	 *
	 * Min-Len: -
	 * Max-Len: 34
	 *
	 * @var string $iban - IBAN of the Account
	 */
	private $iban = '';

	/**
	 * Purpose of bank information
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $transferNote1 - Purpose of bank information | null for none
	 */
	private $transferNote1 = null;

	/**
	 * Purpose of more bank information
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $transferNote2 - Purpose of more bank information | null for none
	 */
	private $transferNote2 = null;

	/**
	 * Bank-Information-Code (BankCCL) of bank account.
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 11
	 *
	 * @var string|null $bic - Bank-Information-Code (BankCCL) of bank account | null for none
	 */
	private $bic = null;

	/**
	 * Account reference to customer profile
	 *
	 * Note: Optional
	 *
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $accountReference - Account reference to customer profile | null for none
	 */
	private $accountReference = null;
	private $value = null;
	private $currency = null;

	/**
	 * Get the Account Owner Name
	 *
	 * @return string - Account Owner Name
	 */
	public function getAccountHolder() {
		return $this->accountHolder;
	}

	/**
	 * Set the Account Owner Name
	 *
	 * @param string $accountHolder - Account Owner Name
	 */
	public function setAccountHolder($accountHolder) {
		$this->accountHolder = $accountHolder;
	}

	/**
	 * Get the Bank-Name
	 *
	 * @return string - Bank-Name
	 */
	public function getBankName() {
		return $this->bankName;
	}

	/**
	 * Set the Bank-Name
	 *
	 * @param string $bankName - Bank-Name
	 */
	public function setBankName($bankName) {
		$this->bankName = $bankName;
	}

	/**
	 * Get the IBAN
	 *
	 * @return string - IBAN
	 */
	public function getIban() {
		return $this->iban;
	}

	/**
	 * Set the IBAN
	 *
	 * @param string $iban - IBAN
	 */
	public function setIban($iban) {
		$this->iban = $iban;
	}

	/**
	 * Get additional Bank-Note (1)
	 *
	 * @return null|string - Bank-Note (1) or null for none
	 */
	public function getTransferNote1() {
		return $this->transferNote1;
	}

	/**
	 * Set addition Bank-Note (1)
	 *
	 * @param null|string $transferNote1 - Bank-Note (1) or null for none
	 */
	public function setTransferNote1($transferNote1) {
		$this->transferNote1 = $transferNote1;
	}

	/**
	 * Get additional Bank-Note (2)
	 *
	 * @return null|string - Bank-Note (2) or null for none
	 */
	public function getTransferNote2() {
		return $this->transferNote2;
	}

	/**
	 * Set additional Bank-Note (2)
	 *
	 * @param null|string $transferNote2 - Bank-Note (2) or null for none
	 */
	public function setTransferNote2($transferNote2) {
		$this->transferNote2 = $transferNote2;
	}

	/**
	 * Get the BIC
	 *
	 * @return null|string - BIC or null for none
	 */
	public function getBic() {
		return $this->bic;
	}

	/**
	 * Set the BIC
	 *
	 * @param null|string $bic - BIC or null for none
	 */
	public function setBic($bic) {
		$this->bic = $bic;
	}

	/**
	 * Get the Account reference
	 *
	 * @return null|string - Account reference or null for none
	 */
	public function getAccountReference() {
		return $this->accountReference;
	}

	/**
	 * Set the Account reference
	 *
	 * @param null|string $accountReference - Account reference or null for none
	 */
	public function setAccountReference($accountReference) {
		$this->accountReference = $accountReference;
	}

	public function getAmountValue() {
		return $this->value;
	}
	public function setAmountValue($amountValue) {
		$this->value = $amountValue;
	}

	public function getAmountCurrency() {
		return $this->currency;
	}
	public function setAmountCurrency($amountCurrency) {
		$this->currency = mb_strtoupper($amountCurrency);
	}

	/**
	 * Returns a DHL-Bank-Class for API v3
	 *
	 * @return StdClass - DHL-Bank-Class
	 * @since 3.0
	 */
	public function getBankClass_v3() {
		$class = new StdClass;
		$class->bankAccount = new stdclass;
		$class->bankAccount->accountHolder = $this->getAccountHolder();
		$class->bankAccount->bankName = $this->getBankName();
		$class->bankAccount->iban = $this->getIban();
		if($this->getBic() !== null)
			$class->bankAccount->bic = $this->getBic();

		if($this->getTransferNote1() !== null)
			$class->transferNote1 = $this->getTransferNote1();
		if($this->getTransferNote2() !== null)
			$class->transferNote2 = $this->getTransferNote2();

		$class->amount = new stdclass;
		$class->amount->value = $this->getAmountValue();
		$class->amount->currency = $this->getAmountCurrency();

		return $class;
	}

}
