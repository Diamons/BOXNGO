<?php
	class ApisController extends AppController{
		
		var $uses = array('Course');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('autocomplete'); 
		}
		
		public function autocomplete(){
			$this->layout = "json";
			
			//Query format
			$queries = explode(" ", $this->request->query['query']);
			$regexString = "^";
			foreach($queries as $q => $val){
				$regexString .= "(?=.*".$val.")";
			}
			$regexString .= ".*$/i";
			
			$regex = new MongoRegex($regexString); 
			$courses = $this->Course->find("all", array("conditions" => array(
				"Course.full_text" => $regex)
			));
			foreach($courses as $a){
				$results['suggestions'][] = array('value' => $a['Course']['full_text'], 'data' => $a['Course']['code']);
			}
			$results['query'] = $this->request->query['query'];
			$this->set("results", $results);
		}
	}