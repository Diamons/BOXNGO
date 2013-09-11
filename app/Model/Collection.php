<?php
	class Collection extends Category{
		//public $hasMany = array('Shop');
		public $order = "Collection.display_name ASC";
		public $hasMany = array('CollectionItem');
		public $actsAs = array("ShopUrl");
		
		public function afterFind($results, $primary=FALSE){
			parent::afterFind($results, $primary);

			if(isset($results[0]['CollectionItem'][0]['Shop'])){
				foreach($results as &$a){
					for($i = 0; $i < count($a['CollectionItem']); $i++){
						$a['CollectionItem'][$i]['Shop']['full_url'] = $this->getFullUrl($a['CollectionItem'][$i]['Shop']['id'],$a['CollectionItem'][$i]['Shop']['permalink']);
					}
				}
			}
			return $results;
		}
	}
