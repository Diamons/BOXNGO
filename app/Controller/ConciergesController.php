<?php
	class ConciergesController extends AppController{
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow(array('hunter_college'));
		}
		
		public function hunter_college(){

			$this->render("concierge");
		}
	}