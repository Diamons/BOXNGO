<?php
	class Order extends AppModel{
		public $belongsTo = array('Shop', 'Payment', 'User' => array(
		'foreignKey' => 'seller_id'
		));
		var $actsAs = array('Shipping.Shipping');

		public $validate = array(
			'tracking_code' => array(
				'checkCarrier'=>array(
					'rule'=>'checkCarrier',
					'message'=>'Please enter either a UPS, FedEx, or USPS tracking number.'
				)
			)
		);
			
		public function afterFind($data, $primary=FALSE){
			for($i = 0; $i < count($data); $i++){
				if(isset($data[$i]['Order']['shipping_amount']) && isset($data[$i]['Order']['shop_amount']))
					$data[$i]['Order']['totalPrice'] = $data[$i]['Order']['shipping_amount'] + $data[$i]['Order']['shop_amount'];
				if(isset($data[$i]['Order']['tracking_code']))
					$data[$i]['Order']['carrier'] = $this->detectCarrier($data[$i]['Order']['tracking_code']);
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
	
	