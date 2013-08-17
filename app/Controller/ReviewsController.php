<?php
	class ReviewsController extends AppController{
		public $uses = array('Image', 'Review');
		public $components = array('Stripe.Stripe');
		
		public function feedback($orderId){
			$order = $this->Order->read(NULL, $orderId);
			debug($order);
			if($this->Auth->user('id') !== $order['Order']['buyer_id']){
				$this->redirect($this->referer());
			}
			if($this->request->is('post')){
				$this->request->data['Review']['user_id'] = $order['User']['id'];
				$this->request->data['Review']['order_id'] = $order['Order']['id'];
				$this->request->data['Review']['reviewer_id'] = $this->Auth->user('id');
				if($this->Review->save($this->request->data)){
					$this->Session->setFlash("Your feedback has been saved and added to the seller's account.", "flash_success");
					$this->Order->id = $order['Order']['id'];
					$this->Order->saveField("reviewed", 1);
					$this->redirect(array('controller' => 'dashboard', 'action' => 'managepurchases'));
				}
			}
			if($order['Order']['status'] !== "delivered" || $order['Order']['status'] !== "paid"){
				$this->Session->setFlash("That order is not valid for feedback. The order must have been delivered before you can leave feedback.", "flash_error");
				$this->redirect($this->referer());
			}
			if($order['Order']['reviewed'] == 1){
				$this->set("review", $this->Review->find("first", array("conditions" => array("order_id" => $order['Order']['id']))));
			}
			$a = $this->Image->find("first", array("conditions" => array("Image.shop_id" => $order['Shop']['id'])));
			$order['Image'] = $a['Image'];
			$shopCount = $this->Shop->find("count", array("conditions" => array("Shop.user_id" => $order['User']['id'], "Shop.canview" => 1)));
			$order['Stripe'] = $this->Stripe->retrieveCharge($order['Payment']['stripe_id']);
			$this->set("order", $order);
			$this->set("shopCount", $shopCount);
		}
	}
