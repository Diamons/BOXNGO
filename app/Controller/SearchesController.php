<?php
	class SearchesController extends AppController {
		public $uses = array('User', 'Shop', 'Image', 'School', 'Category');
		function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('index', 'browse');
		}
		
		public function index($category=NULL){
		debug($this->params->query);
			if(!empty($this->params->query['query'])){
				$search = "%".$this->params->query['query']."%";
				$conditions = array('OR' => array('Shop.name LIKE' => $search, 'Shop.description LIKE' => $search), 'AND' => array('Shop.canview' => 1));
			}else{
				$conditions = array('Shop.canview' => 1);
			}
			$this->paginate = array('conditions' => $conditions, 'limit' => 24, 'order' => array('Shop.id' => 'desc'));
			$results = $this->paginate('Shop');
			if(!empty($this->params->query['query'])){
				$this->set("title_for_layout", "Search for ".$this->params->query['query']);
				$this->set("search", $this->params->query['query']);
			}
			else
				$this->set("title_for_layout", "Browsing BOX'NGO");
			$this->set("results", $results);
		}
		
		public function browse($category=NULL){
			$category = $this->Category->find("first", array("conditions" => array("Category.short_name" => $category)));
			$conditions = array("Shop.category_id" => $category['Category']['id'], "Shop.canview" => 1);
			$this->paginate = array('conditions' => $conditions, 'limit' => 24, 'order' => array('Shop.id' => 'desc'));
			$results = $this->paginate('Shop');
			$this->set("results", $results);
			$this->set("category", $category);
			$this->render("index");
		}
	}
