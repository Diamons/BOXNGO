<?php
	class NotificationsController extends AppController{
		public $uses = array('NotificationItem');
		public function beforeFilter(){
			$this->NotificationItem->clearNotifications($this->Auth->user('id'));
			parent::beforeFilter();
		}
		
		public function index(){
			$this->set("notificationList", $this->NotificationItem->find("all", array("conditions" => array("NotificationItem.user_id" => $this->Auth->user('id')))));
			$this->NotificationItem->clearNotifications($this->Auth->user('id'));
		}
	}
