<?php
	class Category extends AppModel{
		public $displayField = 'display_name';
		public $order = "Category.display_name ASC";
		public $hasMany = array('Shop');

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
			$this->recursive = 1;
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
			parent::beforeSave($options);
			if(!empty($this->data[$this->alias]['short_name'])){
				$this->data[$this->alias]['short_name'] = strtolower(str_replace(" ", "-", trim($this->data[$this->alias]['short_name'])));
			}
			return true;
		}
	}
