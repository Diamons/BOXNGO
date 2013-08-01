<?php
	class UsedCoupon extends AppModel{

		public function alreadyUsed($userId=NULL, $couponId=NULL, $override=FALSE){
			$coupon = $this->find("first", array("conditions" => array("UsedCoupon.user_id" => $userId, "UsedCoupon.coupon_id" => $couponId)));
			if(empty($coupon))
				return false;
			else{
				if(empty($coupon['UsedCoupon']['payment_id']) && !$override){
					$this->delete($coupon['UsedCoupon']['id']);
					return false;
				}
				return true;
			}
		}
	}
