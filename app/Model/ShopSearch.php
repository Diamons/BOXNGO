<?php
	class ShopSearch extends AppModel{
		public $useDbConfig = 'index';
		public $actsAs = array('Elastic.Indexable');
		public $_mapping = array(
			'id' => array('type' => 'integer'),
			'user_id' => array('type' => 'integer'),
			'image' => array('type' => 'string'),
			'shop_id' => array('type' => 'integer'),
			'price' => array('type' => 'float'),
			'name' => array('type' => 'string'),
			'description' => array('type' => 'string'),
			'full_url' => array('type' => 'string'),
			'canview' => array('type' => 'integer'),
			'category_id' => array('type' => 'integer'),
			'display_name' => array('type' => 'string'),
			'created' => array('type' => 'datetime'),
			'modified' => array('type' => 'datetime')
		);
		
		public function saveShop($listing){
			//return true;
			$data = array();
			$data['ShopSearch']['user_id'] = $listing['User']['id'];
			$data['ShopSearch']['shop_id'] = $listing['Shop']['id'];
			$data['ShopSearch']['canview'] = $listing['Shop']['canview'];
			$data['ShopSearch']['category_id'] = $listing['Shop']['category_id'];
			$data['ShopSearch']['image'] = $listing['Image'][0]['url'];
			$data['ShopSearch']['name'] = htmlspecialchars(mysqli_real_escape_string($listing['Shop']['name']));
			$data['ShopSearch']['description'] = htmlspecialchars(mysqli_real_escape_string($listing['Shop']['description']));
			$data['ShopSearch']['full_url'] = $listing['Shop']['full_url'];
			$data['ShopSearch']['display_name'] = htmlspecialchars(mysqli_real_escape_string($listing['User']['display_name']));
			$data['ShopSearch']['price'] = $listing['Shop']['price'];
			$this->save($data);
		}
		
		public function delete($shopId=NULL, $cascade = true){
			return true;
			App::uses('HttpSocket', 'Network/Http');
			$http = new HttpSocket();
			$record = $this->find("first", array("conditions" => array("ShopSearch.shop_id" => $shopId)));
			$results = $http->delete('http://localhost:9200/search/shop_searches/'.$record['ShopSearch']['id']);
			return $results;
		}
		
		public function elasticMapping() {
			return $this->_mapping;
		}
	}
