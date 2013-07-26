<?php
	App::uses('Component', 'Controller');

	class MinfraudComponent extends Component{
		
		public function checkCard($ip,$billingCity,$billingRegion,$billingPostal,$billingCountry,$emailDomain,$email,$shippingAddress,$shippingCity,$shippingRegion,$shippingPostal,$userAgent){
			App::import('Vendor', 'minfraud'.DS.'http'.DS.'src'.DS.'CreditCardFraudDetection');
			$ccfs = new CreditCardFraudDetection;
			$h["license_key"] = "rJDkRUZeaYOX";

			// Required fields
			$h["i"] = $ip;             // set the client ip address
			$h["city"] = $billingCity;             // set the billing city
			$h["region"] = $billingRegion;                 // set the billing state
			$h["postal"] = $billingPostal;              // set the billing zip code
			$h["country"] = $billingCountry;                // set the billing country

			// Recommended fields
			$h["domain"] = $emailDomain;		// Email domain
			//$h["bin"] = "549099";			// bank identification number
			//$h["forwardedIP"] = "24.24.24.25";	// X-Forwarded-For or Client-IP HTTP Header
			// CreditCardFraudDetection.php will take
			// MD5 hash of e-mail address passed to emailMD5 if it detects '@' in the string
			$h["emailMD5"] = $email;
			// CreditCardFraudDetection.php will take the MD5 hash of the username/password if the length of the string is not 32
			//$h["usernameMD5"] = "test_carder_username";
			//$h["passwordMD5"] = "test_carder_password";

			// Optional fields
			//$h["binName"] = "MBNA America Bank";	// bank name
			//$h["binPhone"] = "800-421-2110";	// bank customer service phone number on back of credit card
			//$h["custPhone"] = "212-242";		// Area-code and local prefix of customer phone number
			$h["requested_type"] = "standard";	// Which level (free, city, premium) of CCFD to use
			$h["shipAddr"] = $shippingAddress;	// Shipping Address
			$h["shipCity"] = $shippingCity;	// the City to Ship to
			$h["shipRegion"] = $shippingRegion;	// the Region to Ship to
			$h["shipPostal"] = $shippingPostal;	// the Postal Code to Ship to
			//$h["shipCountry"] = $s;	// the country to Ship to

			//$h["txnID"] = "1234";			// Transaction ID
			//$h["sessionID"] = "abcd9876";		// Session ID

			$h["accept_language"] = "de-de";
			$h["user_agent"] = $userAgent;

			// If you want to disable Secure HTTPS or don't have Curl and OpenSSL installed
			// uncomment the next line
			// $ccfs->isSecure = 0;

			// set the timeout to be five seconds
			$ccfs->timeout = 10;

			// uncomment to turn on debugging
			// $ccfs->debug = 1;

			// how many seconds to cache the ip addresses
			// $ccfs->wsIpaddrRefreshTimeout = 3600*5;

			// file to store the ip address for minfraud3.maxmind.com, minfraud1.maxmind.com and minfraud2.maxmind.com
			// $ccfs->wsIpaddrCacheFile = "/tmp/maxmind.ws.cache";

			// if useDNS is 1 then use DNS, otherwise use ip addresses directly
			$ccfs->useDNS = 0;

			$ccfs->isSecure = 0;

			// next we set up the input hash
			$ccfs->input($h);

			// then we query the server
			$ccfs->query();

			// then we get the result from the server
			$h = $ccfs->output();

			// then finally we print out the result
			$outputkeys = array_keys($h);
			$numoutputkeys = count($h);
			$output = "";
			for ($i = 0; $i < $numoutputkeys; $i++) {
			  $key = $outputkeys[$i];
			  $value = $h[$key];
			  if($key == "riskScore"){
			  	if($value <=6)
			  		return TRUE;
			  }
			  $output .= " = " . $value . "\n";
			}
			return $output;
		}
	}