<?php
	class NotificationItem extends AppModel{
		public $hasOne = array('Notification');
		
		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);
			$this->useDbConfig = 'mongodb';
		}
		
		public function markRead($userId){
			Cache::clearGroup('notifications.'.$userId, 'notifications');
		}
		
		public function afterSave($created){
			parent::beforeSave($created);
			if($created == TRUE){
				$userId = $this->data[$this->alias]['user_id'];
				Cache::increment('notifications.'.$userId, 1, 'notifications');
			}
		}
	}
