<?php
	class SearchesController extends AppController {
		public $uses = array('User', 'Shop', 'Image', 'School', 'Category');
		function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('index', 'browse');
		}
		
		public function index($category=NULL){
			if(!isset($this->params->query['query']))
				$this->params->query['query'] = "";
			$search = "%".$this->params->query['query']."%";
			$conditions = array('OR' => array('Shop.name LIKE' => $search, 'Shop.description LIKE' => $search), 'AND' => array('Shop.canview' => 1));
			$results = $this->Shop->find('all', array('conditions' => $conditions, 'order' => array('Shop.id DESC')));
			for($i = 0; $i < count($results); $i++){
				$userSchool = split("@", $results[$i]['User']['username']);
				if(isset($userSchool[1]))
					$school = $this->School->find("first", array("conditions" => array("School.domain" => $userSchool[1])));
				if(!isset($school['School']['name']))
					$school['School']['name'] = '';
				$results[$i]['School'] = $school['School'];
			}
			//debug($results);
			$this->set("results", $results);
		}
		
		public function browse($category=NULL){
			$category = $this->Category->find("first", array("conditions" => array("Category.short_name" => $category)));
			$conditions = array("Shop.category_id" => $category['Category']['id'], "Shop.canview" => 1);
			$results = $this->Shop->find('all', array('conditions' => $conditions, 'order' => array('Shop.id DESC')));
			for($i = 0; $i < count($results); $i++){
				$userSchool = split("@", $results[$i]['User']['username']);
				$school = $this->School->find("first", array("conditions" => array("School.domain" => $userSchool[1])));
				if(!isset($school['School']['name']))
					$school['School']['name'] = '';
				$results[$i]['User']['school'] = $school['School']['name'];
				$results[$i]['Image'] = Set::sort($results[$i]['Image'], '{n}.Image.id', 'asc');
			}
			//debug($results);
			$this->set("results", $results);
			$this->set("category", $category);
			$this->render("index");
		}
	}