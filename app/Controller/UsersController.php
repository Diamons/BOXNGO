<?php
	class UsersController extends AppController{
		
		var $uses = array('Autologin', 'Favorite', 'Verification', 'Facebook', 'Cookie', 'Thread', 'Message', 'ForgotPassword', 'ShopView');
		var $components = array('Mailchimp.Mailchimp');
		
		function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('index', 'verifyaccount', 'ajaxlogin', 'ajaxregister', 'facebook', 'facebookregister', 'profile', 'forgotpassword');  
			$this->Security->blackHoleCallback = 'blackhole';

		}
		public function blackhole($type) {
		  debug($type);
		}
		public function index(){
			if($this->Auth->loggedIn())
				$this->Auth->redirect();
			
			//Registration
			if(isset($this->request->data['User']['passwordconfirmation']) && $this->request->is('post')){
				if($this->User->save($this->request->data)){
					$verification['Verification']['user_id'] = $this->User->id;
					if($this->Verification->save($verification)){
						$this->verificationEmail($this->request->data['User']['username'], "BOX'NGO Verification Email :: Activate Your Account", "default", array('activation' => $this->Verification->id));
						$this->Session->setFlash("You have successfully been registered! Please check your email for a verification email. Your email is <b>".$this->request->data['User']['username']."</b>", "flash_success");
						$this->redirect('/users/?registered');
					}
					
				}
				else
					$this->Session->setFlash("Please check the form below for any possible errors.", "flash_error");
			} else {
				
				//Login request
				if($this->request->is('post')){
					$user = $this->User->find("first", array("conditions" => array("User.username" => $this->request->data['User']['username'])));
					if(!empty($user)){
						if($user['User']['role'] == "unactivated"){
							$verification = $this->Verification->find("first", array("conditions" => array("Verification.user_id" => $user['User']['id'])));
							$this->verificationEmail($user['User']['username'], "BOX'NGO Verification Email :: Activate Your Account", "default", array('activation' => $verification['Verification']['id']));
							$this->Session->setFlash("Your account is unactivated. For your convenience, we have resent you an activation link in your mailbox at <b>".$user['User']['username']."</b>.", "flash_error");
						
						} else{
							if($this->Auth->login()){
								$hash = $this->UserLogin->saveUser($user['User']['username']);
								$this->Autologin->save(array('Autologin' => array('user_id' => $user['User']['id'], 'hash' => $hash)));
								$this->Session->setFlash("You have successfully been logged in.", "flash_success");
								$this->redirect($this->Auth->redirect());
							} else {
								$this->Session->setFlash("You have entered an incorrect email or password.", "flash_error");
							}
						}
						
					}else{
							$this->Session->setFlash("You have entered an invalid username or password, please try again.", "flash_error");
						}
				}
			}
		}
		
		public function ajaxlogin(){
			$this->layout = "ajax";
			$this->autoRender = false;
		}
		
		public function facebookregister(){
			$user = $this->User->find("first", array("conditions" => array("User.facebook_id" => $this->request->query['fb'])));
			if(empty($user)){
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			}else{
				if($this->request->is('post')){
					$this->User->id = $user['User']['id'];
					if($this->User->save($this->request->data)){
						$verification['Verification']['user_id'] = $this->User->id;
						if($this->Verification->save($verification)){
							$this->verificationEmail($this->request->data['User']['username'], "BOX'NGO Verification Email :: Activate Your Account", "default", array('activation' => $this->Verification->id));
							$this->Session->setFlash("You have successfully been registered! Please check your email for a verification email. Your email is <b>".$this->request->data['User']['username']."</b>", "flash_success");
							$this->redirect('/users/?registered');
						}
					}
				}else{
					if(!empty($user['User']['username'])){
						if($user['User']['role'] == "unactivated"){
							$verification = $this->Verification->find("first", array("conditions" => array("Verification.user_id" => $user['User']['id'])));
							$this->verificationEmail($user['User']['username'], "BOX'NGO Verification Email :: Activate Your Account", "default", array('activation' => $verification['Verification']['id']));
							$this->Session->setFlash("Your account is unactivated. For your convenience, we have resent you an activation link in your mailbox at <b>".$user['User']['username']."</b>.", "flash_error");
						
						} else{
							$this->Session->setFlash("You have successfully been logged in.", "flash_success");	
							if($this->Auth->login($user['User'])){
								$hash = $this->UserLogin->saveUser($user['User']['username']);
								$this->Autologin->save(array('Autologin' => array('user_id' => $user['User']['id'], 'hash' => $hash)));
								$this->redirect($this->Auth->redirect());
							}
						}
					}
				}
			}
		}
		
		public function facebook($self=NULL){
			$accessToken = $_COOKIE['fbAccess'];
			$this->layout = "ajax";
			$this->autoRender = false;
			if(isset($this->request->query['userID'])){
				$user = $this->User->find("first", array("conditions" => array("User.facebook_id" => $this->request->query['userID'])));
				
				//If self, this means we're editing an already existing user
				if($self=="self" && $this->Auth->loggedIn())
					$this->User->id = $this->Auth->user('id');
				elseif(!empty($user))
					$this->User->id = $user['User']['id'];
				$this->User->saveField("facebook_id", $this->request->query['userID']);
				App::uses('HttpSocket', 'Network/Http');
				$HttpSocket = new HttpSocket();
				$results = $HttpSocket->post('https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id='. Configure::read('Facebook.appId') .'&client_secret='. Configure::read('Facebook.secret') .'&redirect_uri=http://theboxngo.com/&fb_exchange_token='. $accessToken);
				$results = explode("access_token=",$results->body);
				$results = explode("&", $results[1]);
				$this->User->saveField('facebook_access_token', $results[0]);
				if($self != "self")
					$this->User->saveField('password', $this->User->randomPassword());
			}else{
				
			}
		}
		public function logout(){
			$this->Session->setFlash("You have successfully been logged out.", "flash_success");
			$this->Cookie->delete('al');
			$this->Auth->logout();
			$this->redirect('/');
		}
		
		public function addfavorite(){
			$this->autoRender = false;
			if($this->request->is('ajax')){
				$listingId = $this->params->query['listingid'];
				//$this->Facebook->forceScrape($this->params->query['url']);
				if(!empty($listingId)){
				//If this isn't already favorited by this user
					$favoriteUnique = $this->Favorite->find("first", array("conditions" => array("Favorite.shop_id" => $listingId, "Favorite.user_id" => $this->Auth->user('id'))));
					if(empty($favoriteUnique)){
						$listing = $this->Shop->read(NULL, $listingId);
						//If the listing actually exists and viewable
						if(isset($listing) && !empty($listing) && $listing['Shop']['canview'] == 1){
							$user = $this->User->read(NULL, $this->Auth->user('id'));
							$favorite['Favorite']['shop_id'] = $listingId;
							$favorite['Favorite']['user_id'] = $this->Auth->user('id');
							$favorite['Favorite']['facebook_story'] = $this->params->query['facebook_story'];
							if($this->Favorite->save($favorite)){
								$this->set("listingname", $listing['Shop']['name']);
								$this->layout = "ajax";
								$this->autoRender = true;
							}
						}
					} else {
						//$this->redirect($this->referer());
					}
				}
			}
		}
		
		public function removefavorite(){
			$this->layout = "ajax";
			if($this->request->is('ajax')){
				$listingId = $this->params->query['listingid'];
				if(!empty($listingId)){
				//If this isn't already favorited by this user
					$favoriteUnique = $this->Favorite->find("first", array("conditions" => array("Favorite.shop_id" => $listingId, "Favorite.user_id" => $this->Auth->user('id'))));
					if(!empty($favoriteUnique)){
						$this->Facebook->removePost($favoriteUnique['Favorite']['facebook_story']);
						$this->Favorite->delete($favoriteUnique['Favorite']['id']);
					} else {
						//$this->redirect($this->referer());
					}
				}
			}
		}
		
		public function paymentinfo(){
			if($this->request->is('post') && !empty($this->request->data)){
				switch($this->request->data['User']['payment']){
					case "Check":
						unset($this->request->data['User']['paypal']);
					break;
					case "Paypal":
						unset($this->request->data['User']['first_name']);
						unset($this->request->data['User']['last_name']);
						unset($this->request->data['User']['streetAddress']);
						unset($this->request->data['User']['city']);
						unset($this->request->data['User']['state']);
						unset($this->request->data['User']['zipcode']);
					break;
				}
				$this->User->id = $this->Auth->user('id');
				if($this->request->data['User']['payment'] == "Check" && empty($this->request->data['User']['first_name']))
					$this->Session->setFlash("Please put in your check payment information.", "flash_error");
				elseif($this->User->save($this->request->data)){
					$this->Session->setFlash("Now that we know how to pay you, let's get started!", "flash_success");
					$this->redirect(array('controller' => 'shops', 'action' => 'shoplist'));
				} else {
					$this->Session->setFlash("Please check the form below for any errors. We want to help make sure you get paid easily!", "flash_error");
				}
			}
		}
		
		public function verifyaccount($verificationId=NULL){
			if(isset($verificationId)){
				$verification = $this->Verification->find("first",array("conditions" => array("Verification.id" => $verificationId, "Verification.activated" => 0)));
				$this->Mailchimp->listSubscribe($verification['User']['username']);
				if(!empty($verification)){
					$this->Mailchimp->initialize($this, array('listId' => '0c5ba54ed0'));
					$this->Verification->id = $verificationId;
					$this->Verification->set("activated", 1);
					$this->Verification->save();
					$user = $this->User->read(NULL, $verification['Verification']['user_id']);
					$this->User->id = $user['User']['id'];
					$this->User->saveField("role", "user");
					$this->Session->setFlash("Your account has successfully been activated! Please login below to begin using BOX'NGO. Your email was <b>".$user['User']['username']."</b>", "flash_success");
				} else {
					$this->Session->setFlash("That activation link was not valid. Please copy and paste the link if necessary.", "flash_error");
				}
			}
			
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		
		public function profile($userId=NULL){
			if($this->Auth->user('role') == "admin")
				Configure::write('debug', 2);
			if(empty($userId)){
				$userId = $this->Auth->user('id');
			}
			$userInfo = $this->User->find("first", array("conditions" => array("User.id" => $userId, "User.banned" => 0)));
			if(empty($userInfo)){
				$this->redirect($this->referer());
				$this->Session->setFlash("Unfortunately we can't find that user.", "flash_error");
			}
			
			$favorites = array();
			$index = 0;
			for($i=0;$i<count($userInfo['Favorite']);$i++){
				$shopTmp = $this->Shop->read(NULL,$userInfo['Favorite'][$i]['shop_id']);
				if(!empty($shopTmp)){
					$favorites[$index] = $shopTmp;
					$index++;
				}
			}
			$index = 0;
			$shopItems = array();
			for($i=0;$i<count($userInfo['Shop']);$i++){
				$shopTmp = $this->Shop->read(NULL,$userInfo['Shop'][$i]['id']);
				if(!empty($shopTmp) && $shopTmp['Shop']['canview'] == 1){
					$shopItems[$index] = $shopTmp;
					$index++;
				}
			}

			$shopIds = $this->Shop->find("list", array("conditions" => array("Shop.user_id" => $userId)));
			$this->set("shopViews", $this->ShopView->find("count", array("conditions" => array("shop_id" => array_keys($shopIds)))));
			$this->set("shopFavorites", $this->Favorite->find("count", array("conditions" => array("shop_id" => array_keys($shopIds)))));
			$this->set("title_for_layout", $userInfo['User']['display_name']); 
			$this->set(compact('favorites', 'userInfo', 'shopItems'));
		}
		
		public function message($userid=NULL,$thread=NULL){
			$this->autoRender = false;
			if(!isset($thread)){
				$user = $this->User->read(NULL,$userid);
				if(!empty($user)){
					$this->request->data['Thread']['receiver_id'] = $user['User']['id'];
					$this->request->data['Thread']['sender_id'] = $this->Auth->user('id');
					if($this->Thread->save($this->request->data)){
						$this->request->data['Message']['thread_id'] = $this->Thread->id;
						$this->request->data['Message']['user_id'] = $this->Auth->user('id');
						$this->request->data['Message']['message'] = $this->request->data['Thread']['message'];
						if($this->Message->save($this->request->data)){
							$this->Session->setFlash("Your message was successfully sent! You will receive an email when you get a reply.", "flash_success");
							parent::sendEmail($user['User']['username'], "BOX'NGO :: You have received a message on BOX'NGO!", "newmessage", array("subject" => $this->request->data['Thread']['subject'], "message" => $this->request->data['Thread']['message']));
						}else{
							$this->Session->setFlash("You must included a subject and message. Your subject cannot be over 250 characters and must be at least 2 characters.", "flash_error");
						}
					}else{
						$this->Session->setFlash("You must included a subject and message. Your subject cannot be over 250 characters and must be at least 2 characters.", "flash_error");
					}
				}else{
				}
			}elseif(isset($thread)){
				$thread = $this->Thread->read(NULL, $thread);
				if(empty($thread) || (($thread['Thread']['sender_id'] != $this->Auth->user('id')) && ($thread['Thread']['receiver_id'] != $this->Auth->user('id')))){
					$this->Session->setFlash("We cannot find that thread.", "flash_error");
					$this->redirect($this->referer());
				}else{
					if(($thread['Thread']['sender_id'] == $this->Auth->user('id'))){
						$thread['Thread']['receiver_read'] = 0;
						$user = $this->User->read(NULL, $thread['Thread']['receiver_id']);
						$this->Thread->id = $thread['Thread']['id'];
						$this->Thread->saveField("receiver_read", 0);
					}elseif($thread['Thread']['receiver_id'] == $this->Auth->user('id')){
						$thread['Thread']['sender_read'] = 0;
						$user = $this->User->read(NULL, $thread['Thread']['sender_id']);
						$this->Thread->id = $thread['Thread']['id'];
						$this->Thread->saveField("sender_read", 0);
					}
					
					if(isset($user)){
						$this->request->data['Message']['thread_id'] = $thread['Thread']['id'];
						$this->request->data['Message']['user_id'] = $this->Auth->user('id');
						$this->request->data['Message']['message'] = $this->request->data['Message']['message'];
						if($this->Message->save($this->request->data)){
							$this->Session->setFlash("Your reply was successfully sent! You will receive an email when you get a reply.", "flash_success");
							parent::sendEmail($user['User']['username'], "BOX'NGO :: You have received a message on BOX'NGO!", "newmessage", array("subject" => $thread['Thread']['subject'], "message" => $this->request->data['Message']['message']));
						}else{
							$this->Session->setFlash("You must included a message. Your message must be at least 5 characters.", "flash_error");
						}
					}
				}
			}
			$this->redirect($this->referer());
		}
		
		public function forgotpassword($id=NULL){
			$this->autoRender = false;
			if($this->request->is('put')){
				$this->autoRender = true;
				if($this->User->save($this->request->data)){
					$this->Session->setFlash("Your password has been changed! Cya on BOX'NGO! :)", "flash_success");
					$this->redirect('/users');
				}
			}
			if(!isset($id)){
				$user = $this->User->find("first", array("conditions" => array("User.username" => $this->request->data['User']['email'])));
				$recovery['ForgotPassword']['user_id'] = $user['User']['id'];
				$this->ForgotPassword->deleteAll(array("ForgotPassword.user_id" => $user['User']['id']));
				if(!empty($user['User']['username']) && $this->ForgotPassword->save($recovery)){
						parent::sendEmail($user['User']['username'], "BOX'NGO :: Account Recovery / Forgot Password", "forgotpassword", array("link" => "http://theboxngo.com/users/forgotpassword/".$this->ForgotPassword->id));
						$this->Session->setFlash("We sent you an email to your inbox at <b>".$user['User']['username']."</b>. Check your email to recover your account.", "flash_success");
						$this->redirect('/users');
				}
			}else{
				$forgotPassword = $this->ForgotPassword->find("first", array("conditions" => array("ForgotPassword.id" => $id, "ForgotPassword.created <" => date("Y-m-d", strtotime("+1 days")))));
				if(empty($forgotPassword)){
					$this->Session->setFlash("That link is incorrect or no longer active. Please reset your password again.", "flash_error");
					$this->redirect('/users');
				}else{
					$this->autoRender = true;
					$this->ForgotPassword->delete($id);
					$this->request->data = $this->User->read(NULL, $forgotPassword['ForgotPassword']['user_id']);
					$this->Session->setFlash("Enter your new password here.", "flash_success");
				}
			}
		}
		private function verificationEmail($email=NULL,$subject=NULL,$layout=NULL,$variables=NULL ){
			parent::sendEmail($email, $subject, $layout, $variables);
		}
		
	}