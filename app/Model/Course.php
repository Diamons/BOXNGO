<?php
	class Course extends AppModel{
	
		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);
			$this->useDbConfig = 'mongodb';
		}
		
		//No longer needed, $result['Course']['full_text'] is inside the database now
		/*public function afterFind($results){
			foreach($results as &$a){
				$a['Course']['fulltext'] = $a['Course']['course_number'] . " Section ".$a['Course']['section']. " - ".$a['Course']['description']. " with Professor ".$a['Course']['professor'];
			}
			
			return $results;
		}*/
	}