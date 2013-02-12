<?php
	class ApisController extends AppController{
		
		var $uses = array('Course');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('autocomplete');
		}
		
		public function autocomplete(){
			$this->layout = "json";
			$courses = $this->Course->find("all", array("conditions" => array("\$or" => array(
				array("Course.professor" => array("\$regex" => ".*".$this->request->query['query'].".*")),
				array("Course.number" => array("\$regex" => ".*".$this->request->query['query'].".*")),
				array("Course.description" => array("\$regex" => ".*".$this->request->query['query'].".*")),
				array("Course.professor" => array("\$regex" => ".*".$this->request->query['query'].".*"))
			))));
			foreach($courses as $a){
				$results['suggestions'][] = array('value' => $a['Course']['fulltext'], 'data' => $a['Course']['code']);
			}
			$results['query'] = $this->request->query['query'];
			$this->set("results", $results);
		}
	}