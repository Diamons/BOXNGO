<?php
	class CronscriptsController extends AppController{
		
		var $uses = array('Order','User');
		var $components = array('Session');
		
		
		//Maybe three times a day ?
		public function cancelOrders(){
			$days = date('Y-m-d', strtotime('-4 days'));
			$this->Order->recursive = -1;
			$oldOrders = $this->Order->find("all", array("conditions" => array("Order.created <=" => $days, "Order.status" => "pending"), "limit" => 10));
			foreach($oldOrders as $order){
				$userEmail = $this->User->read(NULL, $order['Order']['buyer_id']);
				$sellerEmail = $this->User->read(NULL, $order['Order']['seller_id']);
				$currentPayment = $this->Order->Payment->read(NULL, $order['Order']['payment_id']);
				parent::sendEmail("shahruk@theboxngo.com", "BOX'NGO NOTIFICATION :: Order Cancelled", "cancelorder", array('payment' => $currentPayment, 'order' => $order, 'listing' => $this->Order->Shop->read(NULL, $order['Order']['shop_id'])));
				parent::sendEmail($userEmail['User']['username'], "BOX'NGO NOTIFICATION :: Order Cancelled", "cancelorder", array('payment' => $currentPayment, 'order' => $order, 'listing' => $this->Order->Shop->read(NULL, $order['Order']['shop_id'])));
				parent::sendEmail($sellerEmail['User']['username'], "BOX'NGO NOTIFICATION :: Sale Cancelled", "cancelorderseller", array('payment' => $currentPayment, 'order' => $order, 'listing' => $this->Order->Shop->read(NULL, $order['Order']['shop_id'])));
				
				$this->Order->id = $order['Order']['id'];
				$this->Order->save(array("status" => "cancelled", "message" => "No response from seller. System auto cancelled."));
			}
		}
		
		//Run once a day
		public function remindSellers(){
			$days = date('Y-m-d', strtotime('-4 days'));
			$this->Order->recursive = -1;
			$newOrders = $this->Order->find("all", array("conditions" => array("Order.created >=" => $days, "Order.status" => "pending"), "limit" => 1));
			foreach($newOrders as $order){
				$sellerEmail = $this->User->read(NULL, $order['Order']['seller_id']);
				parent::sendEmail($sellerEmail['User']['username'], "BOX'NGO NOTIFICATION :: [REMINDER] Respond to your order request!", "remindseller", array('order' => $order, 'listing' => $this->Order->Shop->read(NULL, $order['Order']['shop_id'])));
			}
		}
	}