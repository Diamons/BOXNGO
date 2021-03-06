<?php
	class ShopsController extends AppController{
		
		public $uses = array('Comment', 'ShopSearch', 'Shop', 'Image', 'Payment', 'School', 'Shopview', 'Facebook', 'Category', 'Favorite', 'Message', 'Thread', 'Trade');
		public $components = array('Cookie');
		public $helpers = array('Time', 'Country.Country');

		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('viewlisting');
			$this->Security->unlockedActions = array('shoplist', 'addcomment');
			$this->Security->blackHoleCallback = 'blackhole';
			
		}
		public function blackhole($type) {
			parent::sendEmail("shahruksemail@gmail.com","BOX'NGO BLACKHOLE! $type");
		}
		
		public function shoplist(){
			$categories = $this->Category->find("list");
			$this->set("categories", $categories);
			$user = $this->User->read(NULL, $this->Auth->user('id'));
			if(empty($user['User']['payment']) || !isset($user['User']['payment']))
				$this->redirect(array('controller' => 'users', 'action' => 'paymentinfo'));
			if($this->request->data && $this->request->is('post'))
			{
				//If custom price for shipping set
				if($this->request->data['Shop']['shipping'] == '1')
					$this->request->data['Shop']['shipping'] = $this->request->data['Shop']['shipping_price'];
				
				$this->request->data['Shop']['user_id'] = $this->Auth->user('id');
				$this->Shop->set($this->request->data);
				if($this->Shop->validates()){
					if(!empty($this->request->data['Shop']['images'])){
						//Permalink
						$this->request->data['Shop']['permalink'] = $this->Shop->permalink($this->request->data['Shop']['name']);
						if($this->Shop->save($this->request->data)){
							$shop = $this->Shop->read(array('Shop.id'), $this->Shop->id);
							$this->Image->saveImages($this->request->data['Shop']['images'], $this->Shop->id);
							$shop = $this->Shop->read(NULL, $this->Shop->id);
							$this->ShopSearch->saveShop($shop);
							$this->Session->setFlash("Congratulations! Your listing has been successfully posted.", "flash_success");
							$this->redirect(array('controller' => 'shops', 'action' => 'share', $this->Shop->id));
						} else {
							$this->Session->setFlash("Please check the form below for any errors you may have.", "flash_error");
						}
					} else {
						$this->Session->setFlash("You must include images with your listing.", "flash_error");
					}
				
				} else {
					$this->Session->setFlash("Please check the form below for any errors you may have.", "flash_error");
				}
			
			}
		}
		
		public function share($listingId=NULL){
			if(empty($listingId))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingId, "Shop.canview" => 1)));
			if(empty($listing)){
				$this->Session->setFlash("Unfortunately we can't find that listing. The seller may have run out of stock. Please contact Support if you believe this is a mistake.", "flash_warning");
				$this->redirect($this->referer());
			} else {
				$this->User->recursive = -1;
				$user = $this->User->read(NULL, $this->Auth->user('id'));
				if(!empty($user['User']['facebook_access_token'])){
					$link = "http://theboxngo.com/shops/viewlisting/".$listingId."/".$listing['Shop']['permalink'];
					$results = $this->Facebook->shareListing($listing['Shop']['name'], $link, $user['User']['facebook_id'], $user['User']['facebook_access_token'], '', $listing['Image'][0]['url']);
					$this->redirect(array('controller' => 'shops', 'action' => 'viewlisting', $listingId,$listing['Shop']['permalink']));
					$this->ShopView->delete(array("ShopView.shop_id" => $listingId));					
				}
				$this->set("shoplink", $listingId);
			}
		}
		
		public function trade($listingid=NULL){
			if(empty($listingid))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "Shop.canview" => 1)));
			
			if(empty($listing)){
				$this->Session->setFlash("Unfortunately we can't find that listing. The seller may have run out of stock. Please contact Support if you believe this is a mistake.", "flash_warning");
				$this->redirect($this->referer());
			} else {
				if(!$this->School->sameSchool($this->Auth->user('username'), $listing['User']['username']) && ($this->Auth->user('id') == $listing['User']['id'] && $this->Auth->user('role') !== "admin")){
					$this->Session->setFlash("Unfortunately you guys aren't in the same school! Currently we do not support interschool trading.", "flash_warning");
					$this->redirect($this->referer());
				
				}else{
					$school = $this->School->getSchool($this->Auth->user('username'));
					$this->set("school", $school);
					$this->set("listing", $listing);
					
					if($this->request->data && $this->request->is('post')){
						parent::sendTradeEmail($listing['User']['username'],$this->Auth->user('username'), "BOX'NGO Trade Request :: ".$listing['Shop']['name'], $listing['Shop']['id'], $this->request->data['Message']['message'], $this->request->data['Message']['contact']); 
						$trade['Trade'] = array('shop_id' => $listing['Shop']['id'], 'user_id' => $this->Auth->user('id'), 'message' => $this->request->data['Message']['message'], 'contact' => $this->request->data['Message']['contact']);
						$this->Trade->save($trade);
						$this->redirect('/shops/viewlisting/'.$listingid);
					} else {
					}
				}
			}
		}
		
		public function viewlisting($listingid=NULL, $permalink=NULL){
			if(empty($listingid))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "OR" => array("Shop.canview" => array(1,2,3)))));
			if(empty($listing)){
				$this->Session->setFlash("Unfortunately we can't find that listing. Please contact Support if you believe this is a mistake.", "flash_warning");
				$this->redirect($this->referer());
			}else{
				if($listing['Shop']['canview'] == 3)
					$this->Session->setFlash("This listing is currently <b>paused</b>. You will be unable to purchase this listing.", "flash_warning");
					
				//None created, mostly for old functions, create and save one.
				if(empty($listing['Shop']['permalink']))
					$this->Shop->addPermalink($listing['Shop']['id'], $listing['Shop']['name']);

				//If came here without one, add one.
				if(empty($permalink) || !isset($permalink)){
					$listing = $this->Shop->read(NULL, $listing['Shop']['id']);
					$this->redirect(array('controller' => 'shops', 'action' => 'viewlisting', $listingid, $listing['Shop']['permalink']), 301);
				}
				if($this->Auth->loggedIn() && $this->Payment->userBoughtAlready($this->Auth->user('id'), $listingid) === true){
					$this->Session->setFlash("You have already purchased this item before.", "flash_warning");
				}
				
				//Set cookie for viewed
				if(!$this->Cookie->read('Viewed.'.$listingid)){
					if($this->Auth->loggedIn())
						$this->Shopview->save(array('Shopview'=>array('shop_id' => $listingid, 'user_id' => $this->Auth->user('id'))));
					else
						$this->Shopview->save(array('Shopview'=>array('shop_id' => $listingid)));
					$this->Cookie->write('Viewed.'.$listingid, 1);
				}

				if($listing['Shop']['canview'] == 2)
					$this->Session->setFlash("This listing has run out of stock and is <b>sold out</b>.", "flash_warning");
				$this->set("title_for_layout", "$".$listing['Shop']['price']." ".$listing['Shop']['name']);
				$this->set("school", $this->School->getSchool($listing['User']['username']));
				if($this->Auth->loggedin()){
					$this->Favorite->recursive = -1;
					$this->set("favorite", $this->Favorite->find("first", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id'), "Favorite.shop_id" => $listingid))));
				}
				$relatedItems = $this->Shop->find("all", array("conditions" => array("Shop.canview" => 1), "order" => "RAND()", "limit" => 8));
				$this->set("comments", $this->Comment->find("all", array("conditions" => array("Comment.shop_id" => $listingid))));
				$sameSchool = $this->School->sameSchool($this->Auth->user('username'), $listing['User']['username']);
				$views = $this->Shopview->find("count", array("conditions" => array("Shopview.shop_id" => $listingid)));
				$this->set(compact("listing", "sameSchool", "relatedItems", "views"));
			}
		}
		
		public function comment($shopid){
			if(empty($shopid) || !$this->request->is('post'))
				$this->redirect($this->referer());
			$this->request->data['Comment']['user_id'] = $this->Auth->user('id');
			$this->request->data['Comment']['shop_id'] = $shopid;
			if(empty($this->request->data['Comment']['message']))
				$this->Session->setFlash("Please no empty comments!", "flash_error");
			elseif($this->Comment->save($this->request->data)){
				$this->Session->setFlash("Your comment was posted!", "flash_success");
				$this->Shop->recursive = 1;
				$shop = $this->Shop->read(NULL, $shopid);
				$this->NotificationItem->notify('comment_listing', $shop['User']['id'], $this->Auth->user('id'), $shopid); 
				//parent::sendEmail($shop['User']['username'],"BOX'NGO :: New comment posted on your listing for ".$shop['Shop']['name'],"newcomment", array('link' => $shop['Shop']['full_url'], 'name' => $shop['Shop']['name']));
			}
			$this->redirect('/shops/viewlisting/'.$shopid);

		}

		public function deletelisting($listingid=NULL){
			if(empty($listingid))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "Shop.user_id" => $this->Auth->user('id'))));
			if(empty($listing)){
				$this->Session->setflash("We couldn't find that listing. Please contact support if you believe this may be a mistake.", "flash_error");
				$this->redirect($this->referer());
			} else {
				$this->Shop->id = $listingid;
				$this->Shop->saveField('canview', 0);
				$this->Favorite->deleteAll(array("Favorite.shop_id" => $listingid), false);
				debug($this->ShopSearch->delete($listingid));
				//$this->redirect(array('controller' => 'dashboard'));
			}
		}
		
		public function holdlisting($listingid=NULL){
			if(empty($listingid))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "Shop.user_id" => $this->Auth->user('id'))));
			if(empty($listing)){
				$this->Session->setflash("We couldn't find that listing. Please contact support if you believe this may be a mistake.", "flash_error");
				$this->redirect($this->referer());
			} else {
				$this->Shop->id = $listingid;
				if($this->Shop->field('canview') == 3){
					$this->Session->setFlash("That listing has been <b>re-enabled.</b> Happy selling!", "flash_success");
					$shop = $this->read(NULL, $listingid);
					$this->ShopSearch->save($shop);
					$this->Shop->saveField('canview', 1);
				}else{
					$this->Session->setFlash("That listing has been placed on hold. You can re-enable the listing at any time by going to edit your listing.", "flash_success");
					$this->ShopSearch->delete($listingid);
					$this->Shop->saveField('canview', 3);
				}
				
				$this->redirect(array('controller' => 'dashboard'));
			}
		}
		
		public function edit($listingid=NULL){
			$categories = $this->Category->find("list");
			$this->set("categories", $categories);
			
			if(empty($listingid))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "Shop.user_id" => $this->Auth->user('id'))));
			if(empty($listing)){
				$this->Session->setflash("We couldn't find that listing. Please contact support if you believe this may be a mistake.", "flash_error");
				$this->redirect($this->referer());
			}
			
			$this->set("edit", $listingid);	
			if($this->request->is('put') && isset($this->request->data)){
				$this->Shop->id = $listingid;
				/* BELOW is duplicate from shoplist */
				if($this->request->data['Shop']['shipping'] == '1')
					$this->request->data['Shop']['shipping'] = $this->request->data['Shop']['shipping_price'];
				$this->Shop->set($this->request->data);
				if($this->Shop->validates()){
					if(!empty($this->request->data['Shop']['images'])){
						$this->request->data['Shop']['permalink'] = $this->Shop->permalink($this->request->data['Shop']['name']);
						if($this->Shop->save($this->request->data)){
							
							$this->Image->saveImages($this->request->data['Shop']['images'], $this->Shop->id);
							$this->Session->setFlash("Congratulations! Your listing has been successfully edited.", "flash_success");
							$this->redirect(array('controller' => 'shops', 'action' => 'viewlisting', $this->Shop->id));
						} else {	
							if($this->request->data['Shop']['shipping'] > 0)
								$this->request->data['Shop']['shipping'] = 1;
							$this->Session->setFlash("Please check the form below for any errors you may have.", "flash_error");
						}
					} else {
						if($this->request->data['Shop']['shipping'] > 0)
							$this->request->data['Shop']['shipping'] = 1;
						$this->Session->setFlash("You must include images with your listing.", "flash_error");
					}
				
				} else {
					if($this->request->data['Shop']['shipping'] > 0)
						$this->request->data['Shop']['shipping'] = 1;
					$this->Session->setFlash("Please check the form below for any errors you may have.", "flash_error");
				}
			} else {
				if(empty($listingid))
					$this->redirect($this->referer());
				$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "Shop.user_id" => $this->Auth->user('id'))));
				if(empty($listing)){
					$this->Session->setflash("We couldn't find that listing. Please contact support if you believe this may be a mistake.", "flash_error");
					$this->redirect($this->referer());
				}
				
				if($listing['Shop']['canview'] == 2)
					$this->Session->setflash("This listing has run out of stock or has become inactive. By clicking save below, you will reactivate the listing.", "flash_warning");
				if($listing['Shop']['canview'] == 0)
					$this->Session->setFlash("That listing has been deleted. Reason: <b>".$listing['Shop']['message']."</b>" , "flash_error");
					
				//Making the data uniform
				$this->request->data = $listing;
				$this->request->data['Shop']['shipping'] = 0;
				if($listing['Shop']['shipping'] > 0){
					$this->request->data['Shop']['shipping'] = 1;
					$this->request->data['Shop']['shipping_price'] = $listing['Shop']['shipping'];
				}
				$images = "";
				for($i = 0; $i < count($listing['Image']); $i++){
					$images = $images.$listing['Image'][$i]['url'].";";
				}
				$this->request->data['Shop']['images'] = $images;
			}
			
			$this->render('shoplist');
		}
	}
