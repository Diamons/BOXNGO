<?php
	class PromotionsController extends AppController{
		public $uses = array('Entry', 'Collection');
		public $components = array('Cookie');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Security->unlockedActions = array('february2013', 'march2013');
			$this->Auth->allow('february2013','march2013', 'june2013', 'july4th');			
		}
		public function february2013($step=NULL){

			$this->Session->setFlash("This promotion has ended.", "flash_warning");

			if($this->Auth->loggedin()){
				$unique = $this->Entry->find("first", array("conditions" => array("Entry.user_id" => $this->Auth->user('id'))));
				if(!empty($unique)){
					$this->Session->setFlash("You have already redeemed a charm.", "flash_error");
					$this->render(false);
				}
				$this->set("promotion", $this->Cookie->read("Promotion"));
				$this->Cookie->write('Promotion.february2013.step1', "true");
				if($this->request->is('post')){
					$this->layout = "json";
					if($step == "step3"){
						if(count($this->request->data['friends']) > 2){
							$this->Cookie->write('Promotion.february2013.step3', true);
							$this->set("results", array('success' => true));
						}else{
							$this->set("results", array('success' => false));
						}
					}
				}else{
					
				}
			}else{
				$this->set("promotion", false);
			}
		}
		
		public function february2013submit(){
			if($this->request->is('post') && $this->request->data){
				$this->request->data['Entry']['user_id'] = $this->Auth->user('id');
				$this->request->data['Entry']['promotion'] = "february2013";
				if($this->Entry->save($this->request->data))
					$this->Session->setFlash("You have successfully redeemed your charm. We will update you via email should we need further information.", "flash_success");
				else
					$this->Session->setFlash("There was an error. Please try again.");
			}
			
			$this->redirect('/');
		}

		public function march2013(){
			$this->set("entered", "false");
			if($this->request->is('post')){
				$this->request->data['Entry']['promotion'] = "march2013madness";
				if($this->Entry->save($this->request->data)){
					$this->Session->setFlash("To redeem, simply use the coupon during checkout!", "flash_success");
					$this->set("entered", "true");
				}
				else
					$this->Session->setFlash("Please correct the errors below." , "flash_error");
			}
			
			$this->set("title_for_layout", "Get 15% Off Your First Purchase!");
		}

		public function june2013(){
			$this->set("title_for_layout", "10% Off and Free T-Shirts on Orders of $10 and Up!");
		}

		public function july4th(){$this->Collection->recursive = 3;
			$this->set("collection", $this->Collection->find("first", array("conditions" => array("Collection.short_name" => "july-4th"))));
			
			$this->set("title_for_layout", "Our Exclusive July 4th Sale!");
		}
	}