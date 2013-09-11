<?php
	class ApisController extends AppController{
		
		public $uses = array('Course', 'Favorite', 'Shop', 'ShopSearch');
		
		public function beforeFilter(){
			$this->Auth->allow('autocomplete'); 
		}
		
		public function autocomplete(){
			$this->layout = "json";
			
			$courses = $this->ShopSearch->find('all', array('conditions' => array('ShopSearch.canview' => 1), 'query' => array('multi_match' => array('fields' => array('ShopSearch.name^2', 'ShopSearch.description'), 'query' => $this->params->query['query'])), 'limit' => 24));
			if(empty($courses)){
				$results['suggestions'][] = array('value' => 'No results found.');
			}else{
				foreach($courses as $a){
					$results['suggestions'][] = array('value' => '<div class="clearfix"><img src="'.$a['ShopSearch']['image'].'/convert?width=65&height=65&fit=crop" />'.h($a['ShopSearch']['name']).'<p>'.substr(h($a['ShopSearch']['description']), 0, 150).'</p></div>', 'data' => $a['ShopSearch']['full_url'], 'display_text' => h($a['ShopSearch']['name']));
				}
			}
			$results['query'] = $this->request->query['query'];
			$this->set("results", $results);
		}

		public function checkfacebookuser(){
			$this->layout = "ajax";
			if(!$this->Auth->loggedIn())
				$this->set("result", "false");
			else{
				if(!$this->Auth->loggedIn())
					$this->set("result", "false");
				else{
					$token = $this->Auth->user('facebook_access_token');
					if(!empty($token))
						$this->set("result", $token);
					else
						$this->set("result", "false");
				}
			}
		}
	}
