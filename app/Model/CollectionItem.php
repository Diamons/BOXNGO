<?php
	class CollectionItem extends AppModel{
		public $hasMany = array('Shop');
		public $belongsTo = array("Collection");


		public function beforeSave($options = array()){
			
			if(isset($this->data[$this->alias]['shop_id'])){
				$newResults = array();
				for($i = 0; $i < count($this->data[$this->alias]['shop_id']); $i++){
					$newResults = explode(',', trim($this->data[$this->alias]['shop_id']));
					debug($newResults);
				}
				$this->data = $newResults;
				debug($this->data);
				die();
				return true;
			}

			
		}
	}