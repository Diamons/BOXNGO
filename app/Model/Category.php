<?php
	class Category extends AppModel{
		var $displayField = 'display_name';
		var $order = "Category.display_name ASC";
		var $hasMany = array('Shop');

		public $validate = array(
			'short_name' => array(
				'required' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter a short name.'
				),
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'That short name has already been used.'
				)
			)
		);

		public function findNonEmpty(){
			$categories = $this->find("all");
			$newCategories;
			$count = 0;
			foreach($categories as $a){
				if(count($a['Shop']) > 0){
					$newCategories[$count] = $a;
					$count++;
				}
			}
			return $newCategories;
		}

		public function beforeSave($options = array()){
			if(!empty($this->data['Category']['short_name'])){
				$this->data['Category']['short_name'] = strtolower(str_replace(" ", "-", trim($this->data['Category']['short_name'])));
			}
			return true;
		}
	}