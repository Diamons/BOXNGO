<?php
	class DashboardsController extends AppController{
		var $uses = array('Favorite', 'Shop', 'Order', 'User', 'Image', 'Message', 'Thread', 'Trade');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->layout = "dashboard";
		}
		public function blackhole($type) {
		  debug($type);
		}
		public function index(){
		
			/*$this->User->recursive = 3;
			$this->set("user", $this->User->read(NULL, $this->Auth->user('id')));
			debug($this->User->read(NULL, $this->Auth->user('id'))); */
			$this->Shop->recursive = 0;
			$this->Favorite->recursive = 0;
			$this->Order->recursive = 0;
			
			$shopItems = array();
			
			$listings = $this->Shop->find("all", array("conditions" => array("Shop.user_id" => $this->Auth->user('id'),"OR" => array("Shop.canview" => array(2,1))), "order" => "Shop.created DESC", "limit" => 4));	
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
			
			//debug($shopItems);
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
			$listings = $this->Shop->find("all", array("conditions" => array("Shop.user_id" => $this->Auth->user('id')), "order" => "Shop.created DESC"));
			$this->set("listings", $listings);
		}
		public function myorders(){
			$orders = $this->Order->find("all", array("conditions" => array("Order.seller_id" => $this->Auth->user('id')), "order" => "Order.created DESC"));
			for($i = 0; $i < count($orders); $i++){
				$a = $this->Image->getShopImage($orders[$i]['Order']['shop_id']);
				$orders[$i]['Image'] = $a['Image'];
			}
			$this->set("orders", $orders);
		}
		
		public function mytrades(){
			$trades = $this->Trade->find("all", array("conditions" => array("Trade.user_id" => $this->Auth->user('id'))));
			for($i = 0; $i < count($trades); $i++){
				$a = $this->Image->getShopImage($trades[$i]['Trade']['shop_id']);
				$trades[$i]['Image'] = $a['Image'];
			}
			$this->set("trades", $trades);
		}
		
		public function myfavorites(){
			$favorites = $this->Favorite->find("all", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id')), "order" => "Favorite.created DESC"));
			for($i=0;$i<count($favorites);$i++){
				$favorites[$i]['Shop']['image'] = $this->Image->getShopImage($favorites[$i]['Shop']['id']);
				$favorites[$i]['Shop']['image'] = $favorites[$i]['Shop']['image']['Image']['url'];
			}
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
				if($this->User->save($this->request->data)){
					$this->Session->setFlash("Your information has been saved!", "flash_success");
				}else{
					$this->Session->setFlash("Please check the form below for any errors.", "flash_error");
				}
			}else{
				$user = $this->User->read(NULL, $this->Auth->user('id'));
				$this->request->data = $user;
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