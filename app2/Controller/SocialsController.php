<?php
	class SocialsController extends AppController{
		public function beforeFilter(){
			parent::beforeFilter();	
			$this->layout = "ajax";
			$this->autoRender = false;
		}
		
		var $uses = array('Shop', 'Facebook');
		
		public function sharefacebook($listingId){
			$this->layout = "ajax";
			$this->autoRender = false;
			if(empty($listingId))
				$this->redirect($this->referer());
			$listing = $this->Shop->find("first", array("conditions" => array("Shop.id" => $listingId, "Shop.canview" => 1)));
			if(empty($listing)){
				$this->Session->setFlash("Unfortunately we can't find that listing. The seller may have run out of stock. Please contact Support if you believe this is a mistake.", "flash_warning");
				$this->redirect($this->referer());
			} else {
				$user = $this->User->read(NULL, $this->Auth->user('id'));
				$link = "http://theboxngo.com/shops/viewlisting/".$listingId;
				$results = $this->Facebook->shareListing($listing['Shop']['name'],$link,$user['User']['facebook_id'],$user['User']['facebook_access_token']);
				$this->Session->setFlash("Your listing has been shared!", "flash_success");
				echo $results;
			}
		}
	}