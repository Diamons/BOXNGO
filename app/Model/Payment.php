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
			$results['applied'] = false;
			$results['Price']['total_price'] = $listing['price'] + $listing['shipping'];
			
			$date = new DateTime("now");
			$date = $date->format("Y-m-d H:i:s");
			
			if($coupon==NULL){
				return $results;
			}
			if($coupon['Coupon']['status'] == 0 || $coupon['Coupon']['status'] == 2){
				$results['error_message'] = "That coupon has expired or is no longer valid.";
				return $results;
			}elseif($date > $coupon['Coupon']['expiration_date']){
				$results['error_message'] = "That coupon has expired.";
				$this->markExpired($coupon['Coupon']['id']);
				return $results;
			}elseif($coupon['Coupon']['quantity'] <= 0){
				$results['error_message'] = "That coupon has run out.";
				return $results;
			}elseif($coupon['Coupon']['minimum'] > $listing['price']){
				$results['error_message'] = "Your order must be a minimum of $".$coupon['Coupon']['minimum']." to use this coupon.";
				return $results;
			}else{
				$results['applied'] = true;
				if($coupon['Coupon']['percent_discount'] > 0)
					$results['Price']['total_price'] = ($listing['price'] - $listing['price']*$coupon['Coupon']['percent_discount']) + $listing['shipping'];
				elseif($coupon['Coupon']['amount_discount'] > 0)
					$results['Price']['total_price'] -= $coupon['Coupon']['amount_discount'];

				$this->useCoupon($coupon['Coupon']['id']);
			}
			debug($results);
			return $results;
		}

		public function useCoupon($id){
			App::import('Model', 'Coupon');
			$couponModel = new Coupon();
			$coupon = $couponModel->read(NULL, $id);
			$coupon['Coupon']['quantity']--;
			if($coupon['Coupon']['quantity'] <= 0)
				$coupon['Coupon']['status'] = 2;
			$couponModel->save($coupon);
		}

		public function markExpired($id){
			App::import('Model', 'Coupon');
			$couponModel = new Coupon();
			$couponModel->id = $id;
			$couponModel->saveField('status', 2);
		}
	
	}