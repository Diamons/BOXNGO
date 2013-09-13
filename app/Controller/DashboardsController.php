<?php
	class DashboardsController extends AppController{
		public $uses = array('Favorite', 'Shop', 'Order', 'Point', 'User', 'Image', 'Message', 'Thread', 'Trade');
		public $helpers = array('Country.Country');
		public $components = array('Rewards');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->layout = "dashboard";
		}
		public function blackhole($type) {
		  debug($type);
		}
		public function index(){
		
			$this->Shop->recursive = 0;
			$this->Favorite->recursive = 0;
			$this->Order->recursive = 0;
			
			$shopItems = array();
			
			$listings = $this->Shop->find("all", array("conditions" => array("Shop.user_id" => $this->Auth->user('id'),"OR" => array("Shop.canview" => array(3,2,1))), "order" => "Shop.created DESC", "limit" => 4));	
			$listingsCount = $this->Shop->find("count", array("conditions" => array("Shop.user_id" => $this->Auth->user('id'),"OR" => array("Shop.canview" => array(2,1)))));	
			$favorites = $this->Favorite->find("all", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id')), "order" => "Favorite.created DESC", "limit" => 4));
			$favoritesCount = $this->Favorite->find("count", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id'))));			
			//$purchases = $this->Order->find("all", array("conditions" => array("Order.buyer_id" => $this->Auth->user('id')), "order" => "Order.created", "limit" => 4));
			$orders = $this->Order->find("all", array("conditions" => array("Order.seller_id" => $this->Auth->user('id')), "order" => "Order.created", "limit" => 4));
			$ordersCount = $this->Order->find("count", array("conditions" => array("Order.seller_id" => $this->Auth->user('id'))));
			//Add shop entries for $shopItems
			// $shopItems[SHOPID][NAME], $lisitngs[SHOPID][IMAGE]
			$this->addUniqueShops($listings, $shopItems);
			$this->addUniqueShops($favorites, $shopItems);
			//$this->addUniqueShops($purchases, $shopItems);
			$this->addUniqueShops($orders, $shopItems);
			$this->set(compact('listingsCount', 'listings', 'favoritesCount', 'favoritesCount', 'favorites', 'ordersCount', 'orders', 'shopItems'));
			
		}
		
		public function managepurchases(){
			$purchases = $this->Order->find("all", array("conditions" => array("Order.buyer_id" => $this->Auth->user('id')), "order" => "Order.created DESC"));
			for($i = 0; $i < count($purchases); $i++){
				$a = $this->Image->getShopImage($purchases[$i]['Order']['shop_id']);
				$purchases[$i]['Image'] = $a['Image'];
			}
			$this->set("purchases", $purchases);
		}
		
		public function myshop(){
			$listings = $this->Shop->find("all", array("conditions" => array("Shop.user_id" => $this->Auth->user('id'),"OR" => array("Shop.canview" => array(3,2,1))), "order" => "Shop.created DESC"));	
			$this->set("listings", $listings);
		}
		public function myorders(){
			$orders = $this->Order->find("all", array("conditions" => array("Order.seller_id" => $this->Auth->user('id')), "order" => "Order.created DESC"));
			for($i = 0; $i < count($orders); $i++){
				$a = $this->Image->getShopImage($orders[$i]['Order']['shop_id']);
				if(!empty($a['Image']))
					$orders[$i]['Image'] = $a['Image'];
			}
			$this->set("orders", $orders);
		}
		
		public function myfavorites(){
			$this->Favorite->recursive = 2;
			$favorites = $this->Favorite->find("all", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id')), "order" => "Favorite.created DESC"));
			$this->set("favorites", $favorites);
		}
		
		public function messages(){
			$threads = $this->Thread->find("all", array("conditions" => array("OR" => array("Thread.receiver_id" => $this->Auth->user('id'), "Thread.sender_id" => $this->Auth->user('id')), "Thread.status" => 1), "order" => "Thread.modified DESC"));
			
			for($i=0;$i < count($threads); $i++){
				$this->User->recursive = 0;
				$threads[$i]['Thread']['unread'] = "read";
				if($threads[$i]['Thread']['receiver_id'] == $this->Auth->user('id')){
					if($threads[$i]['Thread']['receiver_read'] == 0){
						$threads[$i]['Thread']['unread'] = "unread";
					}
					$user = $this->User->read(NULL, $threads[$i]['Thread']['sender_id']);
				}
				else{
					if($threads[$i]['Thread']['sender_read'] == 0){
						$threads[$i]['Thread']['unread'] = "unread";
					}
					$user = $this->User->read(NULL, $threads[$i]['Thread']['receiver_id']);
				}
				$threads[$i]['User'] = $user['User'];
			}
			$this->set("threads", $threads);
		}
		
		public function readmessage($threadId=NULL){
			$thread = $this->Thread->read(NULL, $threadId);
			if(empty($thread) || (($thread['Thread']['sender_id'] != $this->Auth->user('id')) && ($thread['Thread']['receiver_id'] != $this->Auth->user('id')))){
				$this->Session->setFlash("That thread couldn't be found.", "flash_error");
				$this->redirect($this->referer());
			}
			$this->Thread->id = $threadId;
			if(($thread['Thread']['sender_id'] == $this->Auth->user('id')) && ($thread['Thread']['sender_read'] == 0)){
				$this->Thread->save(array('Thread' => array('sender_read' => 1, 'modified' => false)));
			}
			elseif(($thread['Thread']['receiver_id'] == $this->Auth->user('id')) && ($thread['Thread']['receiver_read'] == 0))
				$this->Thread->save(array('Thread' => array('receiver_read' => 1, 'modified' => false)));
			
			$this->User->recursive = 0;
			$thread['User'][$thread['Thread']['sender_id']] = $this->User->read(NULL, $thread['Thread']['sender_id']);
			$thread['User'][$thread['Thread']['receiver_id']] = $this->User->read(NULL, $thread['Thread']['receiver_id']);
			$this->set("thread", $thread);
		}
		
		public function manageaccount(){
			if($this->request->is('post') || $this->request->is('put')){
				$this->request->data['User']['display_name'] = Sanitize::html($this->request->data['User']['display_name'], array('remove' => true));
				if($this->User->save($this->request->data)){
					$this->Session->setFlash("Your information has been saved!", "flash_success");
					$this->redirect($this->referer());
				}else{
					$this->Session->setFlash("Please check the form below for any errors.", "flash_error");
				}
			}else{
				$user = $this->User->read(NULL, $this->Auth->user('id'));
				$this->request->data = $user;
			}
		}
		
		public function earnpoints(){			
			$this->set("earn", $this->Reward->find("all", array("order" => "Reward.points ASC")));
		}
		
		public function hourlymillz(){
			if($this->Rewards->canHourlyMillz($this->Auth->user('id')) == "true"){
				//Do the points, this guy's legit.
				if($this->request->is('ajax')){
					$this->layout = "json";
					$reward = $this->Rewards->generateHourlyMillz();
					$points['Point']['user_id'] = $this->Auth->user('id');
					$points['Point']['rewards_id'] = 0;
					$points['Point']['amount'] = $reward;
					
					if($this->Point->save($points)){
						$spin['Spin']['user_id'] = $this->Auth->user('id');
						$spin['Spin']['points_id'] = $this->Point->id;
						$this->Spin->save($spin);
						$this->set("results", array("result" => $reward));
					}
					$this->render(false);
				}
			}else{
				$this->Session->setFlash("Unfortunately you will need to wait until you can redeem your hourly Millz again. Sorry!", "flash_error");
				$this->redirect(array('controller' => 'dashboards', 'action' => 'earnpoints'));
				
			}
		}
		
		private function addUniqueShops($newEntries, &$shopItems){
			
			for($i = 0; $i < count($newEntries); $i++){
				foreach($newEntries[$i] as $a){
					if(isset($a['shop_id'])){
						if(!array_key_exists($a['shop_id'], $shopItems)){
							$this->Shop->recursive = 0;
							$shopItems[$a['shop_id']] = $this->Image->getShopImage($a['shop_id']);
							$shopTemp = $this->Shop->read('name', $a['shop_id']);
							if(!empty($shopTemp))
								$shopItems[$a['shop_id']]['Shop'] = $shopTemp['Shop'];
						}
					}
					elseif(isset($a['id']) && isset($a['price']) && isset($a['shipping'])){
						if(!array_key_exists($a['id'], $shopItems)){
							$this->Shop->recursive = 0;
							$shopItems[$a['id']] = $this->Image->getShopImage($a['id']);
							$shopTemp = $this->Shop->read('name', $a['id']);
							$shopItems[$a['id']]['Shop'] = $shopTemp['Shop'];
						}
					}
				}
			}
		}
	}
