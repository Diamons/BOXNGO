<?php
	class PromotionsController extends AppController{
		public $components = array('Cookie');
		
		public function beforeFilter(){
			$this->Auth->allow('february2013');
			$this->Security->unlockedActions = array('february2013');
			parent::beforeFilter();
			
			
		}
		public function february2013($step=NULL){
			if($this->Auth->loggedin()){
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
	}