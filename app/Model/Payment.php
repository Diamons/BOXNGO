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
		
	}