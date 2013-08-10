<?php
	class AdminsController extends AppController{
		public $uses = array('Collection', 'CollectionItem', 'Category', 'Image', 'Shop', 'User', 'School');
		public $components = array('Shipping.Shipping', 'RequestHandler');

		public function beforeFilter(){
			parent::beforeFilter();
			$this->Security->unlockedActions = array('editcollection');
			if($this->Auth->user('role') != "admin"){
				throw new NotFoundException("That page could not be found.");
			}else{
				$this->layout = "admin";
				$this->set("orders", $this->Order->find("count", array("conditions" => array("Order.completed" => 0, "Order.status" => "shipped", "Order.payment" => "paypal"))));
			}
			$this->Security->blackHoleCallback = 'blackhole';

		}
		
		public function blackhole($type) {
		  debug($type);
		}
		
		
		public function index(){
		
		}

		public function paypalorders($order=NULL){
			if(!empty($order)){
				$orderTmp = $this->Order->read(NULL, $order);
				$this->Order->id = $order;
				$this->Order->saveField("completed", 1);
				$this->Order->saveField("status", "paid");
				parent::sendEmail($orderTmp['User']['username'], "Payment for Order #".$orderTmp['Order']['id'], "sellerpaidpaypal", array('orderId' => $orderTmp['Order']['id'], 'amount' => round($orderTmp['Order']['totalPrice']*.9, 2), 'originalAmount' => $orderTmp['Order']['totalPrice'], 'username' => $orderTmp['User']['username']));
				$this->Session->setFlash("Seller was notified of payment!", "flash_success");
			}

			$paypalOrders = $this->Order->find("all", array("conditions" => array("Order.completed" => 0, "Order.status" => "shipped", "Order.payment" => "paypal")));
			foreach($paypalOrders as &$a){
				$a['Order']['tracker'] = $this->Shipping->getTracker($a['Order']['tracking_code']);
			}
			$this->set("paypalOrders", $paypalOrders);
		}

		public function checkorders(){
			$startDate1 = date('Y-m-01 00:00:00');
			$endDate1 = date('Y-m-15 00:00:00');
			$startDate2 = date('Y-m-15 00:00:00');
			$endDate2 = date('Y-m-t 23:59:59');

			$this->Order->recursive = 1;
			$checkPayments = $this->Order->find("all", array("fields" => "Order.seller_id", "conditions" => array("Order.completed" => 0, "Order.status" => "shipped", "Order.modified <" => $endDate1, "Order.payment" => "check")));

			$count = 0;
			$checkOrders1= array();
			foreach($checkPayments as $a){
				$checkOrders1[$count] = $this->Order->find("all", array("conditions" => array("Order.seller_id" => $a['Order']['seller_id'], "Order.completed" => 0, "Order.status" => "shipped", "Order.modified >=" => $startDate1, "Order.modified <" => $endDate1, "Order.payment" => "check")));
				for($i = 0; $i < count($checkOrders1[$count]); $i++){
					$checkOrders1[$count][$i]['Order']['carrier'] = $this->Shipping->getTracker($checkOrders1[$count][$i]['Order']['tracking_code']);
				}
				$count++;
			}

			$checkPayments = $this->Order->find("all", array("fields" => "Order.seller_id", "conditions" => array("Order.completed" => 0, "Order.status" => "shipped", "Order.modified >=" => $startDate2, "Order.modified <" => $endDate2, "Order.payment" => "check")));
			
			//Check Orders 2 = after the 15th of the month
			$count = 0;
			$checkOrders2= array();
			foreach($checkPayments as $a){
				$checkOrders2[$count] = $this->Order->find("all", array("conditions" => array("Order.seller_id" => $a['Order']['seller_id'], "Order.completed" => 0, "Order.status" => "shipped", "Order.modified >=" => $startDate2, "Order.modified <" => $endDate2, "Order.payment" => "check")));
				for($i = 0; $i < count($checkOrders2[$count]); $i++){
					$checkOrders2[$count][$i]['Order']['carrier'] = $this->Shipping->getTracker($checkOrders2[$count][$i]['Order']['tracking_code']);
					$checkOrders2[$count]['totalAmount'] += $checkOrders[$count][$i]['Order']['totalPrice'];
				}

				$count++;
			}

			$this->set(compact("checkOrders1", "checkOrders2"));
		}
		
		public function managecollections(){
			$this->set("collections", $this->Collection->find("all"));
			if($this->request->is('post')){
				if($this->Collection->save($this->request->data)){
					$this->Session->setFlash("Saved!", "flash_success");
					$this->redirect($this->referer());
				}
				else
					$this->Session->setFlash("Check error!", "flash_error");
			}
		}

		public function editcollection($id=NULL){
			$this->set("collection", $this->Collection->read(NULL, $id));
			if($this->request->is('post')){
				if($this->CollectionItem->splitSave($this->request->data)){
					$this->Session->setFlash("Good job noob", "flash_success");
					$this->redirect($this->referer());
				}else{
					$this->Session->setFlash("Error!", "flash_error");
					debug($this->CollectionItem->validationErrors);
				}
			}else{
				$this->CollectionItem->recursive = -1;
				$collectionItems = $this->CollectionItem->find("all", array("conditions" => array("CollectionItem.collection_id" => $id)));
				$this->request->data['CollectionItem'] = array();
				$this->request->data['CollectionItem']['shop_id'] = "";
				for($i = 0; $i < count($collectionItems); $i++){
					$this->request->data['CollectionItem']['shop_id'] .= $collectionItems[$i]['CollectionItem']['shop_id'];
					if($i < count($collectionItems)- 1)
						$this->request->data['CollectionItem']['shop_id'] .= ",";
				}
			}
		}

		public function modifyCategories($id=NULL, $delete=FALSE){
			if($delete == "delete"){
				if($this->Category->delete($id)){
					$this->Session->setFlash("Successfully deleted the category", "flash_success");
					$this->redirect('/admin/modifycategories');
				}else{
				}
			}else{
				$categories = $this->Category->find("all");
				$this->set("categories", $categories);
				if(($this->request->is('post') || $this->request->is('put')) && isset($this->request->data)){
					$this->Category->id = $id;
					if($this->Category->save($this->request->data)){
						$this->Session->setFlash("Successfully saved category!", "flash_success");
						$this->redirect($this->referer());
					}else{
						$this->Session->setFlash("Please check below for errors.", "flash_error");
					}
				}else{
					if(isset($id)){
						$category = $this->Category->read(NULL, $id);
						$this->set("category", true);
						$this->request->data = $category;
					}
				}
			}
		}
		
		public function assignCategories(){
			if($this->request->is('post') && !empty($this->request->data)){
				if($this->Shop->saveAll($this->request->data['Shop'])){
					$this->Session->setFlash("Those items have been assigned to their respective categories", "flash_success");
				}else{
				}
			}
			$listings = $this->Shop->find("all", array("conditions" => array("Shop.category_id" => NULL)));
			$categories = $this->Category->find("list");
			$this->set(compact('categories', 'listings'));
		}
		
		public function editSchools($domain=NULL){
			if($this->request->is('post')){
				if($this->School->save($this->request->data)){
					$this->Session->setFlash("Added that school!", "flash_success");
					$this->redirect($this->referer());
				}
			}elseif(isset($domain)){
				$this->request->data['School']['domain'] = $domain;
			}
			$this->User->recursive = 0;
			$users = $this->User->find("all");
			$count = 0;
			$undefinedSchools = array();
			for($i = 0; $i < count($users); $i++){
				if(!empty($users[$i]['User']['username'])){
					$school = $this->School->getSchool($users[$i]['User']['username']);
					if(empty($school)){
						$undefinedSchools[$count] = $this->School->getDomain($users[$i]['User']['username']);
						$count++;
					}
				}
			}
			$this->set("schools", $undefinedSchools);
		}
		
		public function track(){
			if($this->request->is('post'))
				$this->set("result", $this->Shipping->getTracker($this->request->data['Tracking']['code']));
		}
		public function markup(){ }
		public function view($orderId){
			$order = $this->Order->read(NULL, $orderId);
			$order['Shop']['image'] = $this->Image->find("first", array("conditions" => array("Image.shop_id" => $order['Shop']['id'])));
			$this->set(compact('order'));
		} 
	}