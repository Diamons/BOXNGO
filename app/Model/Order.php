<?php
	class Order extends AppModel{
		public $belongsTo = array('Shop', 'Payment');
		var $actsAs = array('Shipping.Shipping');
	
		public $validate = array(
			'tracking_code' => array(
				'checkCarrier'=>array(
					'rule'=>'checkCarrier',
					'message'=>'Please enter either a UPS, FedEx, or USPS tracking number.'
				)
			)
		);
			
		public function afterFind($data){
			for($i = 0; $i < count($data); $i++){
				if(isset($data[$i]['Order']))
					$data[$i]['Order']['totalPrice'] = $data[$i]['Order']['shipping_amount'] + $data[$i]['Order']['shop_amount'];
			}
			return $data;
		}
		
		public function checkCarrier($trackingId){
			debug($this->detectCarrier($trackingId['tracking_code']));
			if($this->detectCarrier($trackingId['tracking_code']) == false)
				return false;
			else
				return true;
		}

	}
	
	