<?php
	class PromotionsController extends AppController{
		var $uses = array('Entry');
		public $components = array('Cookie');
		
		public function beforeFilter(){
			$this->Auth->allow('february2013');
			$this->Security->unlockedActions = array('february2013');
			parent::beforeFilter();
			
			
		}
		public function february2013($step=NULL){
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
	}