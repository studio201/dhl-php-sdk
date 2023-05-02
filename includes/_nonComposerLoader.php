<?php
/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: https://petschko.org/
 * Modified for new API developer.dhl.com from Jahn on 01.05.2023
 * Date: 13.07.2017
 * Time: 21:17
 *
 * Notes:	Require this File if you don't have Composer installed... It will load ALL Classes for this Lib
 * 			But I suggest using Composer instead of this File - Get it here: https://getcomposer.org/
 * 			------------------------------------
 * 			IMPORTANT: Don't use this File, if you use Composer!
 */

// Set correct encoding
mb_internal_encoding('UTF-8');

// Get required classes
// Abstract classes & interfaces first
require_once('Version.php');
require_once('Address.php');
require_once('SendPerson.php');
require_once('LabelResponse.php');

// Now all other classes
require_once('Consignee.php');
require_once('PostOffice.php');
require_once('Locker.php');

require_once('BankData.php');
require_once('BusinessShipment.php');
require_once('Credentials.php');
require_once('Deprecated.php');
require_once('ExportDocPosition.php');
require_once('Customs.php');
require_once('IdentCheck.php');
require_once('LabelData.php');
require_once('LabelFormat.php');
require_once('Product.php');
require_once('ProductInfo.php');
require_once('Response.php');
require_once('ReturnReceiver.php');
require_once('Shipper.php');
require_once('Services.php');
require_once('Shipments.php');
require_once('ShipmentOrder.php');
require_once('Details.php');

