<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
 
App::uses('Sanitize', 'Utility');
class AppController extends Controller {
	var $uses = array('User', 'Shop', 'Order', 'School', 'Message', 'Thread');
	var $components = array('Auth', 'Security', 'Session');
	var $helpers = array('Form');
	
	function beforeFilter(){
		parent::beforeFilter();	  
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'index');
		$this->Auth->authenticate = array('Form', 'all' => array('scope' => array('User.banned' => 0)));
		if($this->Auth->loggedIn()){
			$this->set("notifications", $this->Order->find("count", array("conditions" => array("Order.seller_id" => $this->Auth->user('id'), "Order.status" => array("pending")), "order" => "Order.created")));
			$this->set("messages", $this->Thread->find("count", array("conditions" => array("OR" => array(array("AND" => array("Thread.receiver_id" => $this->Auth->user('id'), "Thread.receiver_read" => 0)), array("AND" => array("Thread.sender_id" => $this->Auth->user('id'), "Thread.sender_read" => 0))), "Thread.status" => 1), "order" => "Thread.modified DESC")));
			$this->set("auth",$this->Auth->user());
			$school = $this->School->getSchool($this->Auth->user('username'));
			$this->set("school", $school);
		}
	}
	
	public function sendEmail($to="shahruksemail@gmail.com",$subject="TEST",$template="default", $variables=NULL){
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('default');
		$email->from(array('shahruk@theboxngo.com' => 'BOXNGO'))
		->to($to)
		->subject($subject)
		->template('default', $template)
		->emailFormat('html');
		$email->viewVars(array("domain" => "http://theboxngo.com/", "variables" => $variables));
		$email->send();
		
	}
	
	public function sendTradeEmail($to, $from, $subject, $listingId, $message, $contact){
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('default');
		$email->subject($subject)
		->template('default', 'trade')
		->from($from)
		->to($to)
		->emailFormat('html');
		$email->viewVars(array("message" => nl2br(h($message)), "contact" => nl2br(h($contact)), "domain" => "http://theboxngo.com/", "listing" => $listingId));
		$email->send();
		
		
	}
}