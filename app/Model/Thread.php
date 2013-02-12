<?php
	class Thread extends AppModel{
		var $validate = array(
			'subject' => array(
				'maxLength' => array(
					'rule' => array('maxLength', '250'),
					'message' => 'Subject may not exceed 250 characters.'
				),
				'minLength' => array(
					'rule' => array('minlength', '10'),
					'message' => 'Your subject must be at least 10 characters.'
				)
			),
			'message' => array(
				'maxLength' => array(
					'rule' => array('maxLength', '2500'),
					'message' => 'Your message may not exceed 2500 characters.'
				),
			)
		);

		var $hasMany = array('Message');
		
		function beforeSave($data){
			if(isset($this->data['Thread']['message'])){
				$this->data['Thread']['message'] = trim($this->data['Thread']['message']);
			}
			return true;
		}
	}