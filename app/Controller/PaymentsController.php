<?php
class PaymentsController extends AppController {
	var $uses = array('Coupon', 'Payment', 'Shop', 'Order');
	var $components = array('Stripe.Stripe', 'Shipping.Shipping');
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Security->unlockedActions = array('process', 'pay');
	}
	
	public function pay($listingId=NULL){
		if(isset($listingId) && !empty($listingId)){
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingId, "Shop.canview" => 1)));
			if(!empty($listing)){
				if($this->Auth->loggedIn() && $this->Payment->userBoughtAlready($this->Auth->user('id'), $listingId) === true){
					$this->Session->setFlash("You have already purchased this item before.", "flash_warning");
				}
				if($this->Auth->user('id') == $listing['User']['id']){
					$this->Session->setFlash("You can't buy your own stuff silly!", "flash_warning");
					$this->redirect($this->referer());
				}
				
				if($this->request->is('post') && !empty($this->request->data['Coupon']['code'])){
					$this->Coupon->set($this->request->data);
					if(!$this->Coupon->validates()){
						$coupon = $this->Coupon->find("first", array("conditions" => array("Coupon.code" => $this->request->data['Coupon']['code'])));
						$this->Session->setFlash("Your coupon has been applied!", "flash_success");
					}
					else
						$this->Session->setFlash("That coupon was not valid! Please try again, or contact support if you believe this is an error.", "flash_error");
				}
				if(!isset($coupon))
					$coupon = NULL;
				$price = $this->Coupon->apply(array('id' => $listing['Shop']['id'], 'price' => $listing['Shop']['price'], 'shipping' => $listing['Shop']['shipping']), $coupon);
				if($price['applied'] == true)
					$this->Session->setFlash("Your coupon has been applied!", "flash_success");
				elseif(isset($coupon) && $price['applied'] == false)
					$this->Session->setFlash($price['error_message'], "flash_error");
				$this->set("stripekey", $this->Stripe->getKey());
				$this->set("price", $price);
				$this->set("listing", $listing);
			} else {
				$this->redirect($this->referer());
			}
		} else {
			$this->redirect($this->referer());
		}
	}
	
	public function process($listingId = NULL){
		if(isset($listingId) && !empty($listingId) && $this->request->is('post') && !empty($this->request->data)){
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingId, "Shop.canview" => 1)));
			if(!empty($listing)){
				$charge = $this->Stripe->charge(array('description' => $this->Auth->user('username'), 'amount'=>$this->Shop->getTotalPrice($listing['Shop']['id']), 'stripeToken' => $this->request->data['stripeToken']));	
				if(is_array($charge)){
					$this->request->data['Payment']['stripe_id'] = $this->request->data['stripeToken'];
					$this->request->data['Payment']['shop_id'] = $listingId;
					$this->request->data['Payment']['email'] = $this->Auth->user('username');
					$this->request->data['Payment']['user_id'] = $this->Auth->user('id');
					$this->request->data['Payment']['shipping_amount'] = $listing['Shop']['shipping'];
					$this->request->data['Payment']['shop_amount'] = $listing['Shop']['price'];
					if(!$this->Payment->save($this->request->data)){
						parent::sendEmail("shahruksemail@gmail.com", "BOX'NGO! URGENT! THIS [PAYMENT] DID NOT SAVE!", "error", $this->request->data);
					}
					$order = array();
					$order['Order']['seller_id'] = $listing['User']['id'];
					$order['Order']['buyer_id'] = $this->Auth->user('id');
					$order['Order']['status'] = "pending";
					$order['Order']['shop_id'] = $listing['Shop']['id'];
					$order['Order']['payment_id'] = $this->Payment->id;
					$order['Order']['shipping_amount'] = $listing['Shop']['shipping'];
					$order['Order']['shop_amount'] = $listing['Shop']['price'];
					if(!$this->Order->save($order)){
						parent::sendEmail("shahruksemail@gmail.com", "BOX'NGO! URGENT! THIS [ORDER] DID NOT SAVE!", "error", $this->request->data);
					} else {
						parent::sendEmail($listing['User']['username'], "[IMPORTANT] You have an order on BOX'NGO!", "order");
						$this->Shop->reduceQuantity($listing['Shop']['id']);
						$this->Session->setFlash("You have successfully purchased that item.", "flash_success");
						$this->redirect(array('controller' => 'dashboard', 'action' => 'managepurchases', $listingId));
					}
				} else {
					$this->Session->setFlash("We encountered an error processing this request. The card could not be charged for the following reason: <b>".$charge."</b>", "flash_error");
					$this->redirect($this->referer());
				}
				
			} else {
				die("A");
			}
		}
	}
	
	public function manageorder($orderId=NULL, $action=NULL, $trackingCode=NULL){
		if(empty($orderId))
			$this->redirect($this->referer());
		$order = $this->Order->find("first", array("conditions" => array("Order.id" => $orderId, "Order.seller_id" => $this->Auth->user('id'))));
		if(isset($action)){
			$this->Order->id = $orderId;
			switch($action){
				case "accept":
					if($order['Order']['status'] == "pending" && $this->Order->saveField("status", "accepted"))
						$this->Session->setFlash("You have accepted the order. You have 5 days to ship the item.", "flash_success");
				break;
				case "cancel":
					if($order['Order']['status'] == "pending" && $this->Order->saveField("status", "cancelled")){
						$this->Shop->addQuantity(1, $order['Shop']['id']);
						$this->Session->setFlash("You have cancelled the order. The buyer will be notified.", "flash_warning");
					}
				break;
				case "ship":
					if($order['Order']['status'] == "accepted" && !empty($this->request->data)){
						if($this->Order->save($this->request->data))
							$this->Order->saveField("status", "shipped");
						else
							$this->Session->setFlash("We couldn't verify that tracking number. Please use either UPS, FedEx, or USPS.", "flash_error");
					}
				break;
			}
		}
		
		$order = $this->Order->find("first", array("conditions" => array("Order.id" => $orderId, "Order.seller_id" => $this->Auth->user('id'))));
		if(empty($order)){
			$this->Session->setFlash("That order could not be found.", "flash_error");
			$this->redirect($this->referer());
		}
		$step = 0;
		switch($order['Order']['status']){
			case "pending":
				$step = 0;
			break;
			case "accepted":
				$step = 2;
			break;
			case "cancelled":
				$step = 1;
			break;
			case "shipped";
				$step = 3;
			break;
			case "paid";
				$step = 4;
			break;
		}
		
		$this->set("step", $step);
		$this->set("order", $order);		
	}
}