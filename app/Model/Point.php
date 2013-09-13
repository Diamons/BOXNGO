<?php
	class Point extends AppModel{
		public $belongsTo = array('Reward');
		
		public function getUserPoints($userId){
			$result = Cache::read('Points.'.$userId, 'long');
			$points = 0;
			if(!$result){
				$result = $this->find("all", array("conditions" => array("Point.user_id" => $userId)));
				for($i = 0; $i < count($result); $i++){
					$points += $result[$i]['Point']['amount'];
				}
				Cache::write('Points.'.$userId, $points, 'long');
				$result = Cache::read('Points.'.$userId, 'long');
			}
			return $result;
		}
		
		public function afterSave($created){
			Cache::delete('Points.'.$this->data[$this->alias]['user_id'], 'long');
		}
	}
