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
			App::import('Model', 'UsedCoupon');
			$usedCoupon = new UsedCoupon();
			if($coupon==NULL){
				return $results;
			}
			if($coupon['Coupon']['status'] == 0 || $coupon['Coupon']['status'] == 2){
				$results['error_message'] = "That coupon has expired or is no longer valid.";
				return $results;
			}if($date > $coupon['Coupon']['expiration_date']){
				$results['error_message'] = "That coupon has expired.";
				$this->markExpired($coupon['Coupon']['id']);
				return $results;
			}if($coupon['Coupon']['quantity'] <= 0){
				$results['error_message'] = "That coupon has run out.";
				return $results;
			}if($coupon['Coupon']['minimum'] > $listing['price']){
				$results['error_message'] = "Your order must be a minimum of $".$coupon['Coupon']['minimum']." to use this coupon.";
				return $results;
			}if(isset($coupon['Coupon']['collection_id'])){
				App::import('Model', 'CollectionItem');
				$collectionItem = new CollectionItem();
				$result = $collectionItem->find("first", array("conditions" => array("CollectionItem.shop_id" => $listing['id'], "CollectionItem.collection_id" => $coupon['Coupon']['collection_id']))); 
				if(empty($result)){
					$results['error_message'] = "That coupon is not valid for this listing.";
					return $results;
				}
			}if($usedCoupon->alreadyUsed($listing['user_id'], $coupon['Coupon']['id'])){
				$results['error_message'] = "You already used that coupon.";
				return $results;
			}else{
				$results['applied'] = true;
				$results['Coupon']['code'] = $coupon['Coupon']['code'];
				if($coupon['Coupon']['percent_discount'] > 0){
					$results['Price']['total_price'] = ($listing['price'] - ($listing['price']*$coupon['Coupon']['percent_discount']) + $listing['shipping']);
					$results['Price']['message'] = "Your coupon has been applied for a ".($coupon['Coupon']['percent_discount'] * 100)."% discount.";
					$results['Price']['discount'] = $listing['price']*$coupon['Coupon']['percent_discount'];
				}elseif($coupon['Coupon']['amount_discount'] > 0){
					$results['Price']['total_price'] -= $coupon['Coupon']['amount_discount'];
					$results['Price']['message'] = "Your coupon has been applied for a $".$coupon['Coupon']['amount_discount']." discount.";
					$results['Price']['discount'] = $coupon['Coupon']['amount_discount'];
				}
				$this->useCoupon($coupon['Coupon']['id']);
			}
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