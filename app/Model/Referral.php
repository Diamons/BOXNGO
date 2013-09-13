<?php
	class Referral extends AppModel{
	
		public function save($userId, $referralId){
			$data[$this->alias]['user_id'] = $userId;
			$data[$this->alias]['referral_id'] = $referralId;
			parent::save($data);
		}
	}
