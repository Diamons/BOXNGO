<?php
	class SearchesController extends AppController {
		public $uses = array('User', 'Shop', 'ShopSearch', 'Image', 'School', 'Category');
		function beforeFilter(){
			parent::beforeFilter();
			if($this->Auth->user('role') == 'admin')
				Configure::write('debug', 0); 
			$this->Auth->allow('index', 'browse');
		}
		
		public function index($category=NULL){
	
			if(!empty($this->params->query['query'])){
				$this->paginate = array('conditions' => array('ShopSearch.canview' => 1), 'order' => array('ShopSearch.shop_id' => 'DESC'), 'query' => array('multi_match' => array('fields' => array('ShopSearch.name^2', 'ShopSearch.description'), 'query' => $this->params->query['query'])), 'limit' => 24);
			}else{
				$this->paginate = array('conditions' => array('ShopSearch.canview' => 1));
			}
			
			$results = $this->paginate('ShopSearch');
			if(!empty($this->params->query['query'])){
				$this->set("title_for_layout", "Search for ".$this->params->query['query']);
				$this->set("search", $this->params->query['query']);
			}
			else
				$this->set("title_for_layout", "Browsing BOX'NGO");
			
			for($i = 0; $i < count($results); $i++){
				$tmpCategory = $this->Category->read(NULL, $results[$i]['ShopSearch']['category_id']);
				$results[$i]['Category'] = array();
				$results[$i]['Category'] = $tmpCategory['Category'];
			}
			debug($results);
			$this->set("results", $results);
		}
		
		public function browse($category=NULL){
			$category = $this->Category->find("first", array("conditions" => array("Category.short_name" => $category)));
			$conditions = array("ShopSearch.category_id" => $category['Category']['id'], "ShopSearch.canview" => 1);
			$this->paginate = array('conditions' => $conditions, 'limit' => 24, 'order' => array('ShopSearch.shop_id' => 'DESC'));
			$results = $this->paginate('ShopSearch');
			for($i = 0; $i < count($results); $i++){
				$tmpCategory = $this->Category->read(NULL, $results[$i]['ShopSearch']['category_id']);
				$results[$i]['Category'] = $tmpCategory['Category'];
			}
			$this->set("results", $results);
			$this->set("category", $category);
			$this->render("index");
		}
	}
