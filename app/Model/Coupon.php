<?php
	class Coupon extends AppModel{
		var $validate = array(
			'code' => array(
				'rule' => 'checkCoupon',
				'message' => 'That coupon was not valid. Please try again, or contact us via Support and we\'d be glad to assist you.'
			)
		);
		
		public function checkCoupon($check){
			$coupon = $this->Find("first", array("conditions" => array("Coupon.code" => $check['code'])));
			if(!empty($coupon))
				return true;
			else
				return false;
		}
	}