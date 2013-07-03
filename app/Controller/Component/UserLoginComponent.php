<?php
	App::uses('Component', 'Controller');

	class UserLoginComponent extends Component{

		var $components = array('Cookie', 'Auth');

		public function saveUser($username){
			$hash = Security::hash($username);
			if(!stristr(env('HTTP_HOST'), 'boxngo.local'))
				$this->Cookie->domain = ".theboxngo.com";
			$this->Cookie->write('al', $hash, true, '2 months');
			return $hash;
		}

		public function checkUser($cookie, $user){
			if(empty($cookie))
				return false;
			if($cookie == $user['Autologin']['hash']){
				return $user['User'];
			}

		}
	}