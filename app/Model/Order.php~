<?php
	class Order extends AppModel{
		public $belongsTo = array('Shop', 'Payment', 'User' => array(
		'foreignKey' => 'seller_id'
		));
		public $actsAs = array('Shipping.Shipping');

		public $validate = array(
			'tracking_code' => array(
				'checkCarrier'=>array(
					'rule'=>'checkCarrier',
					'message'=>'Please enter either a UPS, FedEx, or USPS tracking number.'
				)
			)
		);
		
		public function checkCarrier($trackingId){
			debug($this->detectCarrier($trackingId['tracking_code']));
			if($this->detectCarrier($trackingId['tracking_code']) == false)
				return false;
			else
				return true;
		}
		
		public function getNotifications($userId){
			$result = Cache::read('Orders.'.$userId, 'long');
			if(!$result){
				$result = $this->find("count", array("conditions" => array("Order.seller_id" => $userId, "Order.status" => array("pending")), "order" => "Order.created"));
				Cache::write('Orders.'.$userId, $result, 'long');
			}
			return $result;
			
		}
		
		public function afterFind($data, $primary=FALSE){
			parent::afterFind($data, $primary);
			for($i = 0; $i < count($data); $i++){
				if(isset($data[$i]['Order']['shipping_amount']) && isset($data[$i]['Order']['shop_amount']))
					$data[$i]['Order']['totalPrice'] = $data[$i]['Order']['shipping_amount'] + $data[$i]['Order']['shop_amount'];
				if(isset($data[$i]['Order']['tracking_code']))
					$data[$i]['Order']['carrier'] = $this->detectCarrier($data[$i]['Order']['tracking_code']);
			}
			return $data;
		}
		
		public function afterSave($created){
			if($created == TRUE){
				if(isset($this->data[$this->alias]['seller_id'])){
					Cache::delete('Orders.'.$this->data[$this->alias]['seller_id'], 'long');
				}
			}
		}
		
		

	}
	
	
