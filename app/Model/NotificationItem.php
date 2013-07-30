<?php
	class NotificationItem extends AppModel{
		
		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);
			$this->useDbConfig = 'mongodb';
		}
	}