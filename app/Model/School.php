<?php
	class School extends AppModel{
		
		var $validate = array(
			'domain' => array(
				'rule' => 'isUnique',
				'message' => 'That domain is already taken!'
			)
		);
		
		public function sameSchool($name1, $name2){
			$name1 = split("@", $name1);
			$name2 = split("@", $name2);
			if($name1[1] == $name2[1])
				return true;
			else
				return false;
		}
		
		public function getSchool($email=NULL){
			$email = split("@", $email);
			if(!empty($email[1]))
				return $this->find("first", array("conditions" => array("School.domain" => $email[1])));
		}
		
		public function getDomain($email=NULL){
			$email = split("@", $email);
			return $email[1];
		}
	}