<?php
/**
 * AppShell file
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
 * @since         CakePHP(tm) v 2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Shell', 'Console');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class AppShell extends Shell {
	public $uses = array('Shop', 'ShopSearch');
	public function sendEmail($to="shahruksemail@gmail.com",$subject="TEST",$template="default", $variables=NULL){
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('default');
		$email->from(array('shahruk@theboxngo.com' => 'BOXNGO'))
		->to($to)
		->subject($subject)
		->template($template, 'default')
		->emailFormat('html');
		$email->viewVars(array("domain" => "http://theboxngo.com/", "variables" => $variables));
		$email->send();

	}
	
	public function mapSearches(){
		error_reporting(0);
		$shops = $this->Shop->find("all");
		for($i = 0; $i < count($shops); $i++){
			$this->ShopSearch->saveShop($shops[$i]);
			$this->out($i."/".count($shops).": ".$shops[$i]['Shop']['name']);
		}
	}

}
