<?php
	App::uses('Component', 'Controller');
	
	class RewardsComponent extends Component{
		
		public $uses = array('Spin');
		
		public function canHourlyMillz($userId){
			$this->Spin = ClassRegistry::init('Spin');
			$spin = $this->Spin->find('first', array('conditions' => array('Spin.user_id' => $userId), 'order' => 'Spin.id DESC'));
			if(!$spin)
				return true;
			else{
				$newSpin = new DateTime($spin['Spin']['created']);
				$now = new DateTime('now');
				$newSpin->modify('+1 hour');
				if($now >= $newSpin){
					return true;
				}else{
					return $newSpin->getTimestamp();
				}
			}
		}
		
		public function generateHourlyMillz(){
			$int = rand(0,30);
			if($int >= 29){
				$int = $int * 3;
			}elseif($int >= 20){
				$int = $int * 1.5;
			}
			if(substr($int, -1) == 0)
				$int--;
			return round($int, 0, PHP_ROUND_HALF_DOWN);
		}
	} 
