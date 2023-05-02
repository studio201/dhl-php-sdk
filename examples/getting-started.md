# Getting started

## Install the Project
- **With** [Composer](https://getcomposer.org/): `composer require petschko/dhl-php-sdk`

- **Without** Composer: [Download the newest Version](https://github.com/Petschko/dhl-php-sdk/releases) and put it manually to your Project

## Include the Project

You need to add a small snipped, which autoload all the required files for you. Wherever you want to use it, you have to add this line:

- **With** Composer:
```php
require_once __DIR__ . '/vendor/autoload.php';
```

- **Without** Composer:
```php
require_once(__DIR__ . '/includes/_nonComposerLoader.php');
```

That's it, now you can start to do all the Configuration for you DHL-Logic (Explained in the next steps)

## Usage

_This is just a very basic Tutorial how you can use the DHL-PHP-SDK, I will add more tutorials & examples to the [example](https://github.com/Petschko/dhl-php-sdk/tree/master/examples) to the directory._

First you need to setup your DHL-Credentials:

**TEST**-Credentials:
```php
// You can initial the Credentials-Object with one of the pre-set Test-Accounts
$credentials = new \Jahn\DHL\Credentials(/* Optional: Sandbox-Modus */ true); // Normal-Testuser
$credentials->setApiKey('ApiKey'); // Your API Key from https://developer.dhl.com for Sandbox
```

**LIVE**-Credentials

```php
// Just create the Credentials-Object
$credentials = new \Jahn\DHL\Credentials();

// Setup these Infos: (ALL Infos are Case-Sensitive!)
$credentials->setUser('Your-DHL-Account'); // DHL-Account (Same as if you Login with then to create Manual-Labels)
$credentials->setPass('Your-DHL-Account-Password'); // DHL-Account-Password
$credentials->setEkp('EKP-Account-Number'); // Number of your Account (Provide at least the first 10 digits)
$credentials->setApiKey('ApiKey'); // Your API Key for Production (You can find it in your DHL-Dev-Account)
```

You've set all of the Required Information so far. Now you can Perform several Actions.

### Create a Shipment

_Please note, that you need the `\Jahn\DHL\Credentials` Object with Valid Login-Information for that._

#### Classes used:

- `\Jahn\DHL\Credentials` **(Req)** - Login Information
- `\Jahn\DHL\Shipments` **(Req)** - Details of a Shipment
- `\Jahn\DHL\ShipmentOrder` **(Req)** - A whole Shipment
- `\Jahn\DHL\Shipper` **(Req)** - Sender Details
	- `\Jahn\DHL\SendPerson` (Parent)
		- `\Jahn\DHL\Address` (Parent)
- `\Jahn\DHL\ReturnReceiver` (Optional) - Return Receiver Details
	- `\Jahn\DHL\SendPerson` (Parent)
		- `\Jahn\DHL\Address` (Parent)
- `\Jahn\DHL\Services` (Optional) - Service Details (Many Configurations for the Shipment)
- `\Jahn\DHL\IdentCheck` (Very Optional) - Ident-Check Details, only needed if turned on in Service
- `\Jahn\DHL\BankData` (Optional) - Bank-Information
- `\Jahn\DHL\Customs` (Optional) - Export-Document Information
- `\Jahn\DHL\ExportDocPosition` (Optional) - Export-Document Position Item details
- `\Jahn\DHL\BusinessShipment` **(Req)** - Manages all Actions + Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\Response` **(Req|Auto)** - Response Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\LabelData` **(Req|Auto)** - Label Response Information
	- `\Jahn\DHL\Version` (Parent)

And one of them:
- `\Jahn\DHL\Consignee` **(Req)** - Receiver Details
	- `\Jahn\DHL\SendPerson` (Parent)
		- `\Jahn\DHL\Address` (Parent)
- `\Jahn\DHL\PostOffice` (Optional) - Receiver-Details (Post-Filial)
	- `\Jahn\DHL\Consignee` **(Req|Parent)** - Receiver Details
		- `\Jahn\DHL\SendPerson` (Parent)
			- `\Jahn\DHL\Address` (Parent)
- `\Jahn\DHL\Locker` (Optional) - Receiver-Details (Pack-Station)
	- `\Jahn\DHL\Consignee` **(Req|Parent)** - Receiver Details
		- `\Jahn\DHL\SendPerson` (Parent)
			- `\Jahn\DHL\Address` (Parent)

#### How to create

##### `\Jahn\DHL\Sender`, `\Jahn\DHL\Receiver` & `\Jahn\DHL\ReturnReceiver` Object(s)

You have to create a Sender and a Receiver. They are similar to set, just the XML creation is different so you have to use different Objects for that.

If you want to lookup all values, you can search trough the `\Jahn\DHL\SendPerson` & `\Jahn\DHL\Address` Classes.

Lets start with the Shipper, in the most cases you =). Create a `\Jahn\DHL\Shipper` Object:

```php
$shipper = new \Jahn\DHL\Shipper();
```

Setup all **Required** Information

```php
$shipper->setName1((string) 'Organisation Petschko'); // Can be a Person-Name or Company Name

// You need to seperate the StreetName from the Number and set each one to its own setter
// Example Full Address: "Oberer Landweg 12a"
$shipper->setAddressStreet((string) 'Oberer Landweg');
$shipper->setAddressHouse((string) '12a'); // A Number is ALWAYS needed

$shipper->setPostalCode((string) '21035');
$shipper->setCity((string) 'Hamburg');
$shipper->setCountry((string) 'DEU'); // 3 Chars ONLY
```

You can also add more Information, but they are **Optional**:

```php
// You can add more Personal-Info
$shipper->setName2((string) 'Name Line 2'); // Default: null -> Disabled
$shipper->setName3((string) 'Name Line 3'); // Default: null -> Disabled
// Mostly used in bigger Companies (Contact-Person)
$shipper->setContactName((string) 'Vor und Zuname'); // Default: null -> Disabled
$shipper->setEmail((string) 'sendermail@domain.org'); // Default: null -> Disabled
//Instead of Adress, use a reference Address from Geschäftskundenportal
$shipper->setShipperRef((string) 'Adress XYZ'); // Default: null -> Disabled Instead of Address, it use a reference from DHL Geschäftskundenportal
```

This was the sender Object, you can set all the same Information with the `\Jahn\DHL\Consignee` + `\Jahn\DHL\ReturnReceiver` Class.

**Note**: You can also use `\Jahn\DHL\Locker` or `\Jahn\DHL\PostOffice` instead of `\Jahn\DHL\Consignee`.
Please note, that they need some extra information.

You don't need to create the `\Jahn\DHL\ReturnReceiver` Object if you don't want a return Label.

Next is the Consignee, in the most cases your receiver =). Create a `\Jahn\DHL\Consignee` Object:

```php
$consignee = new \Jahn\DHL\Consignee();
```
Setup all **Required** Information

```php
$consignee->setName1((string) 'Organisation Petschko'); // Can be a Person-Name or Company Name

// You need to seperate the StreetName from the Number and set each one to its own setter
// Example Full Address: "Oberer Landweg 12a"
$consignee->setAddressStreet((string) 'Oberer Landweg');
$consignee->setAddressHouse((string) '12a'); // A Number is ALWAYS needed

$consignee->setPostalCode((string) '21035');
$consignee->setCity((string) 'Hamburg');
$consignee->setCountry((string) 'DEU'); // 3 Chars ONLY
```




##### `\Jahn\DHL\Services` Object

You can also setup more details for your Shipment by using the `\Jahn\DHL\Service` Object. It's an optional Object but may you should look, what you can set to this Object.

I'll not explain the Service-Object because there are too many settings. Please look into the Service-PHP-File by yourself. The fields are well documented.

##### `\Jahn\DHL\Customs` & `\Jahn\DHL\ExportDocPosition` Object(s)

Sometimes you need to create a Export-Document, in that case you need these both Objects. Please inform yourself what you need to do here.

##### `\Jahn\DHL\Details` Object

Now you need to setup the Shipment-Details for your Shipment (like Size/Weight etc). You can do that with the `\Jahn\DHL\Details` Object.
```php
$details = new \Jahn\DHL\Details();
$details->setWeightUom("kg"); // type of measure
$details->setWeightValue(3); // Value of weight

// optional set package Dimesnions
$details->setDimUom("cm");
$details->setDimHeight("10");
$details->setDimLength("20");
$details->setDimWidth("20");
```
##### `\Jahn\DHL\LabelFormat` Object
Defines the Label Format and Document Type
```php
$labelFormat = new LabelFormat();
$labelFormat->setLabelFormat("910-300-600");
//$labelFormat->setLabelFormatRetoure("910-300-610"); // if return label
$labelFormat->setCombinedPrinting(true); // if true return label and return label in one Document
```

```php
// Create the Object with the first 10 Digits of your Account-Number (EKP).
// You can use the \Jahn\DHL\Credentials function "->getEkp((int) amount)" to get just the first 10 digits if longer
$shipments = new \Jahn\DHL\Shipments((string) $credentials->getEkp(10) . '0101'); // Ensure the 0101 at the end (or the number you need for your Product)
```

You can setup details for that, if you need. If you don't set them, it uses the default values _(This Part is Optional)_

```php
// Setup details

// -- Product
/* Setup the Product-Type that you need. Possible Values are:
* PRODUCT_TYPE_NATIONAL_PACKAGE = 'V01PAK';
* PRODUCT_TYPE_INTERNATIONAL_PACKAGE = 'V53WPAK';
* PRODUCT_TYPE_WARENPOST = 'V62WP';
* PRODUCT_TYPE_WARENPOST_INT = 'V66WPI';
* PRODUCT_TYPE_EUROPA_PACKAGE = 'V54EPAK';
* PRODUCT_TYPE_SAME_DAY_PACKAGE = 'V06PAK';
* PRODUCT_TYPE_SAME_DAY_MESSENGER = 'V06TG';
* PRODUCT_TYPE_WISH_TIME_MESSENGER = 'V06WZ';
* PRODUCT_TYPE_AUSTRIA_PACKAGE = 'V86PARCEL';
* PRODUCT_TYPE_AUSTRIA_INTERNATIONAL_PACKAGE = 'V82PARCEL';
* PRODUCT_TYPE_CONNECT_PACKAGE = 'V87PARCEL';
*/
$shipments->setProduct((string) \Jahn\DHL\ShipmentDetails::{ProductType}); // Default: PRODUCT_TYPE_NATIONAL_PACKAGE

// Example:
$shipments->setProduct((string) \Jahn\DHL\ShipmentDetails::PRODUCT_TYPE_INTERNATIONAL_PACKAGE);
// or (the same)
$shipments->setProduct((string) 'V53WPAK');

// -- Date
// You can set a Shipment-Date you have to provide it in this Format: YYYY-MM-DD
// -> The Date MUST be Today or in the future AND NOT a Sunday
$shipments->setShipDate((string) '2017-01-30'); // Default: Today or 1 day higher if Today is a Sunday
// You can also use a timestamp as value, just set the 2nd param to true (Default is false)
$shipments->setShipDate((int) time(), /* useTimeStamp = false */ true);

// -- References
$shipments->setRefNo((string) 'freetext 35 len'); // Default: null -> Disabled

//Shipper **Required**
$shipments->setShipper($shipper); \Jahn\DHL\Shipper Object

//Consignee **Required**
$shipments->setConsignee($consignee); \Jahn\DHL\Consignee Object

//Details **Required**
$shipments->setDetails($details); \Jahn\DHL\Details Object

// When you had set up some services with the \Jahn\DHL\Service Class, you can add them here
$shipments->setServices($service); \Jahn\DHL\Services Object - Default: null -> All Services have default settings

//When you ship out of Europe you need custom declaration
$shipments->setCustoms($customs); \Jahn\DHL\Customs Object

```

##### `\Jahn\DHL\ShipmentOrder` Object

Now you need to create the ShipmentOrder, which is explained here. First we need to create the Object

```php
$shipmentOrder = new \Jahn\DHL\ShipmentOrder();
```

This is the main Object of our Shipment, so we need to add all Child-Object to it. These are **Required**


```php
// Add all the required informations from previous Objects
$shipmentOrder = new \Jahn\DHL\ShipmentOrder();
$shipmentOrder->setLabelResponseType('INCLUDE');  // INCLUDE or URL
$shipmentOrder->setProfile('STANDARD_GRUPPENPROFIL'); // Optional Default: STANDARD_GRUPPENPROFIL
$shipmentOrder->setPrintOnlyIfReceiverIsValid('false'); // Only validated Shipments shoud be executed
$shipmentOrder->setDocFormat("PDF"); // set type or the Documents PDF or ZPL2
$shipmentOrder->setLabelFormat($labelFormat); \Jahn\DHL\LabelFormat Object
$shipmentOrder->setShipments($shipments); \Jahn\DHL\Shipments Object //You can add multiple shipments in one call (up to 30)
```

##### `\Jahn\DHL\BusinessShipment` Object

Finally you can add all together. You have to create the `\Jahn\DHL\BusinessShipment` Object

```php
/*
* Creates the Object:
* - 1st param is the \Jahn\DHL\Credentials Object
* - 2nd param (Optional - Default: false) defines if a test-modus should be used possible values:
* 		Test-Mode (Normal): Credentials::TEST_NORMAL, 'test', true
* 		Test-Mode (Thermo-Printer): Credentials::TEST_THERMO_PRINTER, 'thermo'
* 		Live (No-Test-Mode): false - default
* - 3rd param (Optional - Default: null -> newest) is a float value, that assigns the Version to use
*/
$dhl = new \Jahn\DHL\BusinessShipment($credentials);
$dhl->setProfile('STANDARD_GRUPPENPROFIL'); // Optional Default: STANDARD_GRUPPENPROFIL

```

Here you can add the ShipmentOrder:

````php
// Add all Required (For a CREATE-Shipment-Request) Classes
$dhl->addShipmentOrder($shipmentOrder);
````

#### Create the Request

All set? Fine, now you can finally made the Create-Shipment-Order-Request. Save the Response to a var
````php
// Returns false if the Request failed or \Jahn\DHL\Response on success
$response = $dhl->createShipment();
// or
$response = $dhl->validateShipment();
````

#### Handling the response
First you have to check if the Value is not false
```php
if($response === false) {
	// Do your Error-Handling here

	// Just to show all Errors
	var_dump($dhl->getErrors()); // Get the Error-Array
} else {
	// Handle the Response here

	// Just to show the whole Response-Object
	var_dump($response);
}
```

You can get several Information from the `\Jahn\DHL\Response` Object. Please have a look down where I describe the `\Jahn\DHL\Response` Class.

exit;
### Update a Shipment

It works the same like creating a Shipment, but you need to specify the Shipment number, you want to update! You call this
request via `$dhl->updateShipmentOrder($shipmentNumber)`.
```php
	$dhl->updateShipmentOrder((string) $shipmentNumber)
```


### Delete one or multiple Shipment(s)

_Please note, that you need the `\Jahn\DHL\Credentials` Object with Valid Login-Information for that._

You also need the Shipment-Number(s), from the Shipment(s), that you want to cancel/delete.

#### Classes used

- `\Jahn\DHL\Credentials` **(Req)** - Login Information
- `\Jahn\DHL\BusinessShipment` **(Req)** - Manages all Actions + Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\Response` **(Req|Auto)** - Response Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\LabelData` **(Req|Auto)** - Label Response Information
	- `\Jahn\DHL\Version` (Parent)

#### How to create

Deleting one or multiple Shipment(s) is not very hard, it just works like this:
```php
// Create a \Jahn\DHL\BusinessShipment Object with your credentials
$dhl = new \Jahn\DHL\BusinessShipment($credentials);

// Send a deletetion Request for ONE Shipment
$response = $dhl->deleteShipment((string) 'shipment_number');

// You can also delete MULTIPLE Shipments at once (up to 30) it looks like this:
$response = $dhl->deleteShipment((array) array('shipment_number1', 'shipment_number2'));
```

Same like when creating a Shipment-Order, the Response is `false` if the Request failed.
For more Information about the Response, look down where I describe the `\Jahn\DHL\Response` Class.

### Re-Get one or multiple Label(s)

_Please note, that you need the `\Jahn\DHL\Credentials` Object with Valid Login-Information for that._

You also need the Shipment-Number(s), from the Shipment(s), where you want to Re-Get Label(s).

#### Classes used

- `\Jahn\DHL\Credentials` **(Req)** - Login Information
- `\Jahn\DHL\BusinessShipment` **(Req)** - Manages all Actions + Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\Response` **(Req|Auto)** - Response Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\LabelData` **(Req|Auto)** - Label Response Information
	- `\Jahn\DHL\Version` (Parent)

#### How to create

Same like deleting, re-getting Labels is not this hard. You can simply re-get Labels:

```php
// As usual create a \Jahn\DHL\BusinessShipment Object with your Credentials
$dhl = new \Jahn\DHL\BusinessShipment($credentials);

// This is the only setting you can do here: (Change Label-Response Type) - Optional
$dhl->setLabelResponseType((string) \Jahn\DHL\BusinessShipment::RESPONSE_TYPE_B64); // Default: null -> DHL-Default

// And here comes the Request for ONE Shipment
$response = $dhl->getShipmentLabel((string) 'shipment_number');

// And for MULTI-Requests (up to 30)
$response = $dhl->getShipmentLabel((array) array('shipment_number1', 'shipment_number2'));
```

If the request failed, you get `false` as usual else a `\Jahn\DHL\Response` Object.

### DoManifest

_Please note, that you need the `\Jahn\DHL\Credentials` Object with Valid Login-Information for that._

You also need the Shipment-Number for the Manifest _(If you need it, you will know how to use this)_.

I personally don't know for what is this for, but it works!

#### Classes used

- `\Jahn\DHL\Credentials` **(Req)** - Login Information
- `\Jahn\DHL\BusinessShipment` **(Req)** - Manages all Actions + Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\Response` **(Req|Auto)** - Response Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\LabelData` **(Req|Auto)** - Label Response Information
	- `\Jahn\DHL\Version` (Parent)

#### How to create

It works like deleting Shipments:
```php
// Create a \Jahn\DHL\BusinessShipment Object with your credentials
$dhl = new \Jahn\DHL\BusinessShipment($credentials);

// Do the Manifest-Request for ONE Shipment
$response = $dhl->doManifest((string) 'shipment_number');

// MULTI-Request (up to 30)
$response = $dhl->doManifest((array) array('shipment_number1', 'shipment_number2'));
```

If the request failed, you get `false` else a `\Jahn\DHL\Response` Object.
For more Information about the Response, look down where I describe the `\Jahn\DHL\Response` Class.

### GetManifest

_Please note, that you need the `\Jahn\DHL\Credentials` Object with Valid Login-Information for that._

I personally also don't know for what is this for, but it works!

#### Classes used

- `\Jahn\DHL\Credentials` **(Req)** - Login Information
- `\Jahn\DHL\BusinessShipment` **(Req)** - Manages all Actions + Information
	- `\Jahn\DHL\Version` (Parent)
- `\Jahn\DHL\Response` **(Req|Auto)** - Response Information
	- `\Jahn\DHL\Version` (Parent)

#### How to create

The syntax is quite simple, you just need to specify the date where you want to have the manifest:

```php
// Create a \Jahn\DHL\BusinessShipment Object with your credentials
$dhl = new \Jahn\DHL\BusinessShipment($credentials);

// Request to get the manifest from a specific date, the date can be given with an ISO-Date String (YYYY-MM-DD) or with the `time()` value of the day
$response = $dhl->getManifest('2018-08-06');
```

If the request failed, you get `false` else a `\Jahn\DHL\Response` Object.
For more Information about the Response, look down where I describe the `\Jahn\DHL\Response` Class.

### `\Jahn\DHL\Response` Object

If you get a Response that is not `false`, you have to mess with the `\Jahn\DHL\Response` Object.

This Object helps you, to get easy to your Goal. You can easily get the Values you need by using the getters. _(IDEs will detect them automatic)_

I will explain which values you can get from the Response-Object

```php
// You can get the GLOBAL-Status of all Labels by using these functions
(int) $response->getStatusCode(); // Returns the Status-Code (Difference to DHL - Weak-Validation is 1 not 0) - See below
(string) $response->getStatusText(); // Returns the Status-Text or null
(string) $response->getStatusMessage(); // Returns the Status-Message (More details) or null

// You can get the "getManifest"-Data always by using this function after the getManifest call
(string) $response->getManifestData(); // Returns the Manifest PDF-Data as Base64 String (Can be obtained via getManifest) or null

// You can still use these for SINGLE-Requests
(string) $response->getShipmentNumber(); // Returns the Shipment-Number of the Request or null
(string) $response->getLabel(); // Returns the Label URL or Base64-Label-String or null
(string) $response->getReturnLabel(); // Returns the ReturnLabel (URL/B64) or null
(string) $response->getExportDoc(); // Returns the Export-Document (URL/B64) or null (Can only be obtained if the Export-Doc Object was added to the Shipment request)
(string) $response->getSequenceNumber(); // Returns your provided sequence number or null
(string) $response->getCodLabel(); // Returns the Cod-Label or null
```

You can get all these values for MULTI-Requests as well, but it's a bit different...
First you can request how many items we got from the response by using:
```php
(int) $response->countLabelData(); // Returns how many items are in the response object - Return values: 0 - 30
```

You can access every item by using  `$response->getLabelData((null|int) $index);`. When you use `null`, you get the whole array, else the specific `\Jahn\DHL\LabelData`-Item chosen by the index.

You can get the values like this: (For the first item for example)

```php
// Status Values of each request (Every Request-Item has their own status)
(int) $response->getLabelData(0)->getStatusCode(); // Returns the Status-Code of the 1st Request (Difference to DHL - Weak-Validation is 1 not 0) - See below
(string) $response->getLabelData(0)->getStatusText(); // Returns the Status-Text of the 1st Request or null
(string) $response->getLabelData(0)->getStatusMessage(); // Returns the Status-Message (More details) of the 1st Request or null

// Info-Values
(string) $response->getLabelData(0)->getShipmentNumber(); // Returns the Shipment-Number of the 1st Request or null
(string) $response->getLabelData(0)->getLabel(); // Returns the Label URL or Base64-Label-String of the 1st Request or null
(string) $response->getLabelData(0)->getReturnLabel(); // Returns the ReturnLabel (URL/B64) of the 1st Request or null
(string) $response->getLabelData(0)->getExportDoc(); // Returns the Export-Document (URL/B64) of the 1st Request or null (Can only be obtained if the Export-Doc Object was added to the Shipment request)
(string) $response->getLabelData(0)->getSequenceNumber(); // Returns your provided sequence number of the 1st Request or null
(string) $response->getLabelData(0)->getCodLabel(); // Returns the Cod-Label of the 1st Request or null
```

Just to show you a simple loop, how you can handle every Request-Item:
```php
for($i = 0; $i < $response->countLabelData(); $i++) {
	// For example get the Shipment-Number of every item
	$shipmentNumber = $response->getLabelData($i)->getShipmentNumber();

	// (...) Do stuff with every Request-Item here
}
```

If a value is not set you get usually `null` as result. Not every Action fills out all of these values!

You can also take a look at the Class Constants, they are helping you to identify the Status-Codes:

```php
const \Jahn\DHL\Response::ERROR_NOT_SET = -1;
const \Jahn\DHL\Response::ERROR_NO_ERROR = 0;
const \Jahn\DHL\Response::ERROR_WEAK_WARNING = 1;
const \Jahn\DHL\Response::ERROR_SERVICE_TMP_NOT_AVAILABLE = 500;
const \Jahn\DHL\Response::ERROR_GENERAL = 1000;
const \Jahn\DHL\Response::ERROR_AUTH_FAILED = 1001;
const \Jahn\DHL\Response::ERROR_HARD_VAL_ERROR = 1101;
const \Jahn\DHL\Response::ERROR_UNKNOWN_SHIPMENT_NUMBER = 2000;
```
