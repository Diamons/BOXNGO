<?php
	class SchoolsController extends AppController{
		var $uses = array('School', 'Shop', 'User');
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow("index");
		}
		
		public function index($short=NULL, $action=NULL){
			$school = $this->School->find("first", array("conditions" => array("School.short_id" => $short)));
			$search = "%@".$school['School']['domain'];
			$users = $this->User->find("all", array("conditions" => array("User.username LIKE" => $search)));
			$usersCount = count($users);
			$listings = array();
			$count = 0;
			for($i=0; $i < $usersCount; $i++){
				if(!empty($users[$i]['Shop'])){
					for($k = 0; $k < count($users[$i]['Shop']); $k++){
						$a = $this->Shop->find("first", array("conditions" => array("Shop.id" => $users[$i]['Shop'][$k]['id'], "Shop.canview" => 1)));
						if(!empty($a)){
							$listings[$count] = $a;
							$count++;
						}
					}
				}
			}
			
			$this->set("userscount", $usersCount);
			$this->set("listings", $listings);
			$this->set("title_for_layout", $school['School']['name']);
			$this->set("school", $school);
		}
	}