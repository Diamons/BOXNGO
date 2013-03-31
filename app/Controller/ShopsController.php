<?php
	class ShopsController extends AppController{
		
		var $uses = array('Shop', 'Image', 'Payment', 'School', 'Shopview', 'Facebook', 'Category', 'Favorite', 'Message', 'Thread', 'Trade');
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('viewlisting');
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
						if($this->Shop->save($this->request->data)){
							$this->Image->saveImages($this->request->data['Shop']['images'], $this->Shop->id);
							$this->Facebook->scrape("http://theboxngo.com/shops/viewlisting/".$this->Shop->id);
							die();
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
					$link = "http://theboxngo.com/shops/viewlisting/".$listingId;
					$results = $this->Facebook->shareListing($listing['Shop']['name'], $link, $user['User']['facebook_id'], $user['User']['facebook_access_token'], '', $listing['Image'][0]['url']);
					$this->redirect(array('controller' => 'shops', 'action' => 'viewlisting', $listingId));					
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
		
		public function viewlisting($listingid=NULL){
			if(empty($listingid))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingid, "OR" => array("Shop.canview" => array(1,2)))));
			
			if(empty($listing)){
				$this->Session->setFlash("Unfortunately we can't find that listing. Please contact Support if you believe this is a mistake.", "flash_warning");
				$this->redirect($this->referer());
			} else {
				if($this->Auth->loggedIn() && $this->Payment->userBoughtAlready($this->Auth->user('id'), $listingid) === true){
					$this->Session->setFlash("You have already purchased this item before.", "flash_warning");
				}
				if($this->Auth->loggedIn())
					$this->Shopview->save(array('Shopview'=>array('shop_id' => $listingid, 'user_id' => $this->Auth->user('id'))));
				
				if($listing['Shop']['canview'] == 2)
					$this->Session->setFlash("This listing has run out of stock and is <b>sold out</b>.", "flash_warning");
				$this->set("title_for_layout", $listing['Shop']['name']);
				$this->set("school", $this->School->getSchool($listing['User']['username']));
				if($this->Auth->loggedin()){
					$this->Favorite->recursive = -1;
					$this->set("favorite", $this->Favorite->find("first", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id'), "Favorite.shop_id" => $listingid))));
				}
				
				$relatedItems = $this->Shop->find("all", array("conditions" => array("Shop.canview" => 1), "order" => "RAND()", "limit" => 6));
				$this->set("categories", $this->Category->find("all"));
				$sameSchool = $this->School->sameSchool($this->Auth->user('username'), $listing['User']['username']);
				$this->set(compact("listing", "sameSchool", "relatedItems"));
			}
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