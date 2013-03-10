<?php
	class Payment extends AppModel{
	
	var $actsAs = array('Shipping.Shipping');
	
		function userBoughtAlready($userId=NULL, $listingId=NULL){
			$result = $this->find("first", array("conditions" => array("Payment.user_id" => $userId, "Payment.shop_id" => $listingId)));
			if(!empty($result))
				return true;
			else
				return false;
		}
		
		public function paymentTotal($listing, $coupon=NULL){
			$results = array();
			$results['Price']['applied'] = false;
			$results['Price']['total_price'] = $listing['price'] + $listing['shipping'];
			
			$date = new DateTime("now");
			$date = $date->format("Y-m-d H:i:s");
			
			if($date > $coupon['Coupon']['expiration_date'])
				$results['Price']['error_message'] = "That coupon has expired.";
			elseif($coupon['Coupon']['status'] == 0 || $coupon['Coupon']['status'] == 2)
				$results['Price']['error_message'] = "That coupon has expired or is no longer valid.";
			if($coupon==NULL){
				
			}else{
				//if($coupon['Coupon']['expiration_date'] 
				$results['Price']['applied'] = true;
			}
			
			return $results;
		}
		
	}