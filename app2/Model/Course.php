<?php
	class Course extends AppModel{
		var $actsAs = array('CsvImport');

		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);
			$this->useDbConfig = 'mongodb';
		}
		
		public function afterFind($results){
			foreach($results as &$a){
				$a['Course']['fulltext'] = $a['Course']['course_number'] . " Section ".$a['Course']['section']. " - ".$a['Course']['description']. " with Professor ".$a['Course']['professor'];
			}
			
			return $results;
		}
	}