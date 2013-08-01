<?php
	class NotificationItem extends AppModel{
		public $belongsTo = array('Notification', 'User');
		
		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);
			$this->useDbConfig = 'mongodb';
		}
		
		public function clearNotifications($userId){
			Cache::write('notifications.'.$userId, 0, 'long');
		}
		
		public function notify($type, $userId, $actionUserId, $attachmentId=0){
			$notification = $this->Notification->find("first", array("conditions" => array("Notification.name" => $type), "fields" => array("Notification.id")));
			$data = array('NotificationItem' => array('notification_id' => $notification['Notification']['id'], 'attachment_id' => $attachmentId, 'user_id' => $userId, 'other_user' => $actionUserId));
			$this->save($data);
		}
		
		public function afterFind($results, $primary = FALSE){
			for($i = 0; $i < count($results);  $i++){
				$notifications = $this->Notification->read(NULL, $results[$i][$this->alias]['notification_id']);
				$results[$i]['Notification'] = $notifications['Notification'];
				
				$user = $this->User->read(NULL, $results[$i]['NotificationItem']['other_user']);
				$results[$i]['User'] = $user['User'];
			}
			return $results;
		}
		
		public function afterSave($created){
			parent::afterSave($created);
			if($created == TRUE){
				$userId = $this->data[$this->alias]['user_id'];
				Cache::increment('notifications.'.$userId, 1, 'long');
			}
		}
	}
