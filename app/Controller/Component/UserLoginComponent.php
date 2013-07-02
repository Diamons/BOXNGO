<?php
	App::uses('Component', 'Controller');

	class UserLoginComponent extends Component{

		var $components = array('Cookie');
		var $uses = array('Autologin');

		public function saveUser($username){
			$hash = Security::hash($username);
			$this->Cookie->domain = ".theboxngo.com";
			$this->Cookie->write('al', $hash, true, '2 months');
			return $hash;
		}

		public function checkUser($cookie, $user){
			if(empty($cookie))
				return false;
			if($cookie == $user['Autologin']['hash'])
				return $user['User'];

		}
	}