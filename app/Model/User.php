<?php
	class User extends AppModel{

		public $validate = array(
			'username' => array(
				'required' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter a proper email address.'
				),
				'email' => array(
					'rule' => 'email',
					'message' => 'Please enter a proper email adddress.'
				),
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'That email address has already been used.'
				),
				'eduaddress' => array(
					'rule' => array('eduAddress'),
					'message'=>'You need a valid .EDU email address to register (beta only).'
				)
			),
			'facebook_id' => array(
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'That Facebook account has already been linked.',
					'on' => 'create'
				)
			),
			'passwordcreate' => array(
				'required' => array(
					'rule' => 'notEmpty',
					'message' => 'A password is required.'
				),
				'minlength' => array(
					'rule' => array('minlength', 6),
					'message' => 'Please select a password greater than 6 characters.'
				),
				'mustmatch' => array(
					'rule'=>array('passwordMatch'),
					'message' => 'Please make sure that the password fields match.'
				)
			),
			'paypal' => array(
				'email' => array(
					'rule' => 'email',
					'message' => 'Please enter a proper Paypal email address.'
				)
			),
			'zipcode' => array(
				'zipNumber' => array(
					'rule' => 'numeric',
					'message' => 'Please enter a proper mailing zipcode.',
					'allowEmpty' => true
				)
			),
			'first_name' => array(
				'notempty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please put in your first name.',
					'allowEmpty' => true	
				)
			),
			'last_name' => array(
				'notempty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please put in your last name.',
					'allowEmpty' => true			
				)
			),
			'display_name' => array(
				'notempty' => array(
					'rule' => 'notEmpty',
					'message' => 'Choose a display name.'
				),
				'minlength'=>array(
					'rule'=>array('minLength', 3),
					'allowEmpty'=>true,
					'message'=>'Please use a name with at least 3 characters!'
				),
				'maxlength'=>array(
					'rule'=>array('maxlength', 20),
					'allowEmpty'=>true,
					'message'=>'Your name can\'t be longer than 20 characters!'
				),
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'That name has already been taken.'
				)
			),
			'profile_info' => array(
				'rule' => array('maxlength', 1000),
				'message' => 'Please keep it under 1,000 characters.'
			),
			'accepttos' => array(
				'agree' => array(
					'rule' => array('comparison', '!=', 0),
					'required' => true,
					'message' => 'You must agree to the terms of use',
					'on' => 'create'
				)
			),
			'seller_city' => array(
				'rule' => 'notEmpty',
				'message' => 'You must input a city. This is used to help buyers know where purchases are shipping from.'
			),
			'country' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'You must select a country.'
				),
				'lengthMinimum' => array(
					'rule' => array('maxLength', 2),
				)
			)
		);
		
		public $hasMany = array('Favorite', 'Shop', 
			'Purchase' => array('className' => 'Order', 'foreignKey' => 'buyer_id'), 
			'Order' => array('className' => 'Order', 'foreignKey' => 'seller_id'),
			'ForumModerator' => array('className' => 'Forum.Moderator'),
			'ForumPollVote' => array('className' => 'Forum.PollVote'),
			'ForumPost' => array('className' => 'Forum.Post'),
			'ForumSubscription' => array('className' => 'Forum.Subscription'),
			'ForumTopic' => array('className' => 'Forum.Topic'));
		
		public function eduAddress($check){
			return true;
			$userDomain = explode("@", $check['username']);
			if((strtolower(substr($check['username'], -4)) != ".edu") && "facebook.com" != $userDomain[1] && "theboxngo.com" != $userDomain[1])
				return false;
			else
				return true;
		}
		
		public function randomPassword(){
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass); //turn the array into a string
		}
		
		public function passwordMatch(){
			if($this->data[$this->alias]['passwordcreate'] == $this->data[$this->alias]['passwordconfirmation']){
				$this->data[$this->alias]['password'] = $this->data[$this->alias]['passwordcreate'];
				return true;
			} else {
				return false;
			}
		}
		
		public function afterFind($results, $primary = FALSE){
			parent::afterFind($results, $primary);
			if(isset($results[0]['User']) && empty($results[0]['User']['display_name'])){
				for($i = 0; $i < count($results); $i++){
					$a = explode("@", $results[$i]['User']['username']);
					$results[$i]['User']['display_name'] = $a[0];
				}
			}
			elseif(isset($results['display_name']) && empty($results['display_name'])){
					if(isset($results['User'])){
						$a = explode("@", $results['User']['username']);
						$results['User']['display_name'] = $a[0];
					}elseif(isset($results['username'])){
						$a = explode("@", $results['username']);
						$results['display_name'] = $a[0];
					}
			}
			if(isset($results[0]) && empty($results[0]['User']['profilepic']))
				$results[0]['User']['profilepic'] = '/images/avataricon.gif';
			return $results;
		}
		
		public function beforeSave($options = array()) {
			parent::beforeSave($options);
			if (isset($this->data[$this->alias]['password'])) {
				//$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
				$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
			}
			
			if(isset($this->data[$this->alias]['profilepic'])){
				if(!filter_var($this->data[$this->alias]['profilepic'], FILTER_VALIDATE_URL) && !($this->data[$this->alias]['profilepic'] == "/images/avataricon.gif"))
					return false;
			}
			return true;
		}
	}
