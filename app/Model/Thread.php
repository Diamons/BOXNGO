<?php
	class Thread extends AppModel{
		var $validate = array(
			'subject' => array(
				'maxLength' => array(
					'rule' => array('maxLength', '250'),
					'message' => 'Subject may not exceed 250 characters.'
				),
				'minLength' => array(
					'rule' => array('minlength', '2'),
					'message' => 'Your subject must be at least 2 characters.'
				)
			),
			'message' => array(
				'maxLength' => array(
					'rule' => array('maxLength', '2500'),
					'message' => 'Your message may not exceed 2500 characters.'
				),
			)
		);

		public $hasMany = array('Message');
		
		public function getUserMessages($userId){
			$result = Cache::read('Thread.'.$userId.'.messages', 'long');
			if(!$result){
				$result = $this->find("count", array("conditions" => array("OR" => array(array("AND" => array("Thread.receiver_id" => $userId, "Thread.receiver_read" => 0)), array("AND" => array("Thread.sender_id" => $userId, "Thread.sender_read" => 0))), "Thread.status" => 1), "order" => "Thread.modified DESC"));
				Cache::write('Thread.'.$userId.'.messages', $result, 'long');
			}
			return $result;
		}
		function beforeSave($data = array()){
			parent::beforeSave($data);
			if(isset($this->data['Thread']['message'])){
				$this->data['Thread']['message'] = trim($this->data['Thread']['message']);
			}
			return true;
		}
		
		public function afterSave($created){
			Cache::delete('Thread.'.$this->data[$this->alias]['receiver_id'].'.messages', 'long');
			Cache::delete('Thread.'.$this->data[$this->alias]['sender_id'].'.messages', 'long');
		}
	}
