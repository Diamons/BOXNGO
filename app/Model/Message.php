<?php
	class Message extends AppModel{
		var $validate = array(
			'message' => array(
				'maxLength' => array(
					'rule' => array('maxLength', '2500'),
					'message' => 'Your message may not exceed 2500 characters.'
				),
				'minLength' => array(
					'rule' => array('minlength', '2'),
					'message' => 'Your subject must be at least 2 characters.'
				)
			)
		);
		
		var $belongsTo = array('Thread', 'User');
		function beforeSave($data){
			if(isset($this->data['Message']['message'])){
				$this->data['Message']['message'] = trim($this->data['Message']['message']);
			}
			return true;
		}
	}