<?php
class PaymentsController extends AppController {
	var $uses = array('Coupon', 'FakeOrder', 'Payment', 'Shop', 'Order', 'UsedCoupon');
	var $components = array('Stripe.Stripe', 'Shipping.Shipping', 'Maxmind.Minfraud');
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Security->unlockedActions = array('process', 'pay');
	}

	public function pay($listingId=NULL){
		//REDIRECT TO HTTPS IF REQUEST IS NOT HTTPS
		if($_SERVER['SERVER_NAME'] !== 'boxngo.local' && $_SERVER['HTTPS']!="on"){
			$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header( "HTTP/1.1 301 Moved Permanently" );
			header("Location:$redirect");
			exit;
		}
		//$this->Session->setFlash("Payments are currently disabled while we perform maintenance and implement security features. - 7/10/13", "flash_warning");
		//redirect($this->referer());
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
				
				$coupon = NULL;

				if($this->request->is('post') && !empty($this->request->data['Coupon']['code'])){
					$this->request->data['Coupon']['code'] = strtolower($this->request->data['Coupon']['code']);
					$this->Coupon->set($this->request->data);
					if(!$this->Coupon->validates()){
						$this->Session->setFlash("That coupon was not valid! Please try again, or contact support if you believe this is an error.", "flash_error");
					}else{
						$coupon = $this->Coupon->find("first", array("conditions" => array("Coupon.code" => $this->request->data['Coupon']['code'])));
					}
				}
				$price = $this->Payment->paymentTotal(array('id' => $listing['Shop']['id'], 'user_id' => $this->Auth->user('id'), 'price' => $listing['Shop']['price'], 'shipping' => $listing['Shop']['shipping']), $coupon);
				if($price['applied'] == true){
					$this->Session->setFlash("Your coupon has been applied!", "flash_success");
					$this->UsedCoupon->save(array('UsedCoupon' => array('user_id' => $this->Auth->user('id'), 'coupon_id' => $coupon['Coupon']['id'])));
				}
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
		//REDIRECT TO HTTPS IF REQUEST IS NOT HTTPS
		if($_SERVER['SERVER_NAME'] !== 'boxngo.local' && $_SERVER['HTTPS']!="on"){
			$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header( "HTTP/1.1 301 Moved Permanently" );
			header("Location:$redirect");
			exit;
		}
		if(isset($this->request->data['Coupon']['code']) && !empty($this->request->data['Coupon']['code'])){
			$coupon = $this->Coupon->find("first", array("conditions" => array("Coupon.code" => $this->request->data['Coupon']['code'])));
			if(!$this->UsedCoupon->alreadyUsed($this->Auth->user('id'), $coupon['Coupon']['id'], true)){
				$this->Session->setFlash("A coupon error has occurred." , "flash_error");
				$this->redirect($this->referer());
			}
		}
		if(isset($listingId) && !empty($listingId) && $this->request->is('post') && !empty($this->request->data)){
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingId, "Shop.canview" => 1)));
			if(!empty($listing)){
				$charge = $this->Stripe->charge(array('description' => $this->Auth->user('username'), 'amount'=>$this->Shop->getTotalPrice($listing['Shop']['id']), 'stripeToken' => $this->request->data['stripeToken']));	
				$a = $this->Stripe->retrieveCharge($charge['stripe_id']);
				if(is_array($charge)){
					$this->request->data['Payment']['stripe_id'] = $this->request->data['stripeToken'];
					$this->request->data['Payment']['shop_id'] = $listingId;
					$this->request->data['Payment']['email'] = $this->Auth->user('username');
					$this->request->data['Payment']['user_id'] = $this->Auth->user('id');
					$this->request->data['Payment']['shipping_amount'] = $listing['Shop']['shipping'];
					$this->request->data['Payment']['shop_amount'] = $listing['Shop']['price'];
					$this->request->data['Payment']['ip_address'] = $_SERVER['REMOTE_ADDR'];
					if(!$this->Payment->save($this->request->data)){
						parent::sendEmail("shahruksemail@gmail.com", "BOX'NGO! URGENT! THIS [PAYMENT] DID NOT SAVE!", "error", $this->request->data);
					}else{
						if(isset($coupon) && !empty($coupon['Coupon']))
							$usedCoupon = $this->UsedCoupon->find("first", array("conditions" => array("UsedCoupon.user_id" => $this->Auth->user('id'), "UsedCoupon.coupon_id" => $coupon['Coupon']['id'])));
						if(!empty($usesdCoupon))
							$usedCoupon['UsedCoupon']['payment_id'] = $this->Payment->id;
					}
					$order = array();
					$order['Order']['seller_id'] = $listing['User']['id'];
					$order['Order']['buyer_id'] = $this->Auth->user('id');
					$order['Order']['status'] = "pending";
					$order['Order']['shop_id'] = $listing['Shop']['id'];
					$order['Order']['payment_id'] = $this->Payment->id;
					$order['Order']['shipping_amount'] = $listing['Shop']['shipping'];
					$order['Order']['shop_amount'] = $listing['Shop']['price'];
					$order['Order']['payment'] = $listing['User']['payment'];
					$a = $this->Stripe->retrieveCharge($charge['stripe_id']);
					$email = $this->Auth->user('username');
					$emailDomain = explode('@', $email);
					$fraudCheck = $this->Minfraud->checkCard($_SERVER['REMOTE_ADDR'],$a['card']['address_city'], $a['card']['address_state'], $a['card']['address_zip'],$a['card']['address_country'], $emailDomain[1],$email,$this->request->order['Payment']['streetAddress'],$this->request->data['Payment']['city'],$this->request->data['Payment']['state'],$this->request->data['Payment']['zipcode'],$_SERVER['HTTP_USER_AGENT']);
					
					//Not fraud
					if($fraudCheck == TRUE){
						//Save
						if(!$this->Order->save($order))
							parent::sendEmail("shahruksemail@gmail.com", "BOX'NGO! URGENT! THIS [ORDER] DID NOT SAVE!", "error", $this->request->data);
						$order['FakeOrder'] = $order['Order'];
						if(!$this->FakeOrder->save($order))
							parent::sendEmail("shahruksemail@gmail.com", "BOX'NGO! URGENT! THIS [ORDER] DID NOT SAVE!", "error", $this->request->data);
						//parent::sendEmail("support@theboxngo.com", "[IMPORTANT] Possible fraud!", "fraud", array("output" => $fraudCheck, "stripeInfo" => $a, "ip" => $_SERVER['REMOTE_ADDR']));
						parent::sendEmail($listing['User']['username'], "[IMPORTANT] You have an order on BOX'NGO!", "order");
						parent::sendEmail($this->Auth->user('username'), "Order Confirmation for BOX'NGO!", "orderconfirmation", $listing);
					}else{
						//Marked as false, we're gonna store it in the database.
						$order['FakeOrder'] = $order['FakeOrder'];
						if(!$this->FakeOrder->save($order))
							parent::sendEmail("shahruksemail@gmail.com", "BOX'NGO! URGENT! THIS [ORDER] DID NOT SAVE!", "error", $this->request->data);
						parent::sendEmail("support@theboxngo.com", "[IMPORTANT] Possible fraud!", "fraud", array("output" => $fraudCheck, "stripeInfo" => $a, "ip" => $_SERVER['REMOTE_ADDR']));
					}
					$usedCoupon['UsedCoupon']['order_id'] = $this->Order->id;
					$this->UsedCoupon->save($usedCoupon);
					$this->Shop->reduceQuantity($listing['Shop']['id']);
					$this->Session->setFlash("You have successfully purchased that item.", "flash_success");
					$this->redirect(array('controller' => 'dashboard', 'action' => 'managepurchases', $listingId));
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
						if($this->Order->save($this->request->data)){
							$this->Order->saveField("status", "shipped");
							parent::sendEmail("support@theboxngo.com", "ORDER NEEDS MANAGING");
							$this->Session->setFlash("Your code is being tracked! Your payment is coming soon!", "flash_success");
					}else
							$this->Session->setFlash("We couldn't verify that tracking number. Please use either UPS, FedEx, or USPS.", "flash_error");
				break;
				}
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