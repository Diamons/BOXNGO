<?php
	class ReviewsController extends AppController{
		public $uses = array('Image');
		public $components = array('Stripe.Stripe');
		
		public function feedback($orderId){
			$order = $this->Order->read(NULL, $orderId);
			$a = $this->Image->find("first", array("conditions" => array("Image.shop_id" => $order['Shop']['id'])));
			$order['Image'] = $a['Image'];
			$shopCount = $this->Shop->find("count", array("conditions" => array("Shop.user_id" => $order['User']['id'], "Shop.canview" => 1)));
			$order['Stripe'] = $this->Stripe->retrieveCharge($order['Payment']['stripe_id']);
			$this->set("order", $order);
			$this->set("shopCount", $shopCount);
		}
	}
