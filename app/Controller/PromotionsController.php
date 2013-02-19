<?php
	class PromotionsController extends AppController{
		
		public function beforeFilter(){
			$this->Auth->allow('february2013');
			parent::beforeFilter();
			
			
		}
		public function february2013(){
		
		}
	}