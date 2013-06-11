<?php
	class CollectionItem extends AppModel{
		public $hasMany = array('Shop');
		public $belongsTo = array("Collection");

		public $validate = array(
			'shop_id' => array(
				'rule' => array('mustExist'),
				'message' => 'Shop ID doesn\'t exist!'
			)
		);

		public function mustExist($check){
			App::import('Model', 'Shop');
			$shop = new Shop();
			$shop->recursive = -1;
			$shopItem = $shop->read('id', $check['shop_id']);
			if(!empty($shopItem))
				return true;
			else
				return "Shop Item ID# ".$check['shop_id']." doesn't exist!";
		}

		public function splitSave($data = array()){
			$collectionId = $data['CollectionItem']['collection_id'];
			if(isset($data[$this->alias]['shop_id'])){
				$newResults = array();
				for($i = 0; $i < count($data[$this->alias]['shop_id']); $i++){
					$newResults = explode(',', trim($data[$this->alias]['shop_id']));
				}
				$data = array();
				for($i = 0; $i < count($newResults); $i++){
					$data[][$this->alias] = array ('shop_id' => $newResults[$i], 'collection_id' => $collectionId);
				}
				
			}
			if($this->saveMany($data))
				return true;
			else
				return false;
		}
	}