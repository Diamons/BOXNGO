<?php
	class Shop extends AppModel{

		public $validate = array(
			'name' => array(
				'notEmpty'=>array(
					'rule'=>'notEmpty',
					'message'=>'Please enter a name for your listing.'
				),
				'minlength'=>array(
					'rule'=>array('minLength', 4),
					'message'=>'Your name must be at least 4 characters long.'
				),
				'maxlength'=>array(
					'rule'=>array('maxLength',100),
					'message'=>'Your name cannot be more than 100 characters long.'
				)
			),
			'category_id' => array(
				'realcategory' => array(
					'rule' => array('categoryAllowed'),
					'message' => 'Please select a proper category.'
				)
			),
			'description' => array(
				'minlength'=>array(
					'rule'=>array('minLength', 10),
					'allowEmpty'=>true,
					'message'=>'Please use a description with at least 10 characters!'
				)
			),
			'quantity' => array(
				'range'=>array(
					'rule'=>array('quantityRange', 1, 10),
					'message'=>'This value must be between 1 and 10!'
				)
			),
			'price'=> array(
				'notempty'=>array(
					'rule'=>'notEmpty',
					'message'=>'Please put in a price for your listing.'
				),
				'numeric'=>array(
					'rule'=>'numeric',
					'message'=>'Please enter a numeric value for the price.'
				),
				'minimumvalue'=>array(
					'rule'=>array('minprice',.50),
					'message'=>'Please enter a minimum price of .50'
				)
			)
		);
		
		var $hasMany = array('Image', 'Favorite');
		var $belongsTo = array('User', 'Category');
		
		function minprice($check, $limit){
			if($check['price'] >= $limit)
				return true;
			else
				return false;
			
		}
		
		public function categoryAllowed($check){
			App::uses('Category', 'Model');
			$category = new Category();
			$category = $category->find("all");
			$allowed = false;
			for($i = 0; $i < count($category); $i++){
				if($category[$i]['Category']['id'] == $check['category_id'])
					$allowed = true;
			}
			return $allowed;
		}
		
		public function quantityRange($check, $min, $max){
			if($check['quantity'] >= $min && $check['quantity'] <= $max){
				return true;
			}
			else{
				return false;
			}
		}
		
		function getTotalPrice($listingId){
			$listing = $this->read(NULL, $listingId);
			return $listing['Shop']['price'] + $listing['Shop']['shipping'];
		}
		
		function reduceQuantity($listingId){
			$this->recursive = 0;
			$listing = $this->read(NULL, $listingId);
			$listing['Shop']['quantity']--;
			if($listing['Shop']['quantity'] <= 0){
				$listing['Shop']['quantity'] = 0;
				$listing['Shop']['canview'] = 2;
			}
			
			$this->id = $listingId;
			$this->save($listing);
		}
		
		function addQuantity($amount, $listingId){
			$this->recursive = 0;
			$listing = $this->read(NULL, $listingId);
			$listing['Shop']['quantity']++;
			if($listing['Shop']['quantity'] >= 1){
				$listing['Shop']['canview'] = 1;
			}
			
			$this->id = $listingId;
			$this->save($listing);
		}

		function permalink($title, $delimiter='-'){
			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
			if(substr($clean, -1, 1) == "-")
				$clean = substr($clean, 0, -1);

			return $clean;
		}

		function addPermalink($listingId, $listingName){
			$tmpPerma = $this->permalink($listingName);
			$this->id = $listingId;
			$this->saveField('permalink', $tmpPerma);
		}
		
		public function afterFind($results){

			foreach($results as &$a){
				$a['Shop']['full_url'] = "http://theboxngo.com/shops/viewlisting/".$a['Shop']['id']."/".$a['Shop']['permalink'];
			}return $results;
		}

		function beforeSave($data){
			if(isset($this->data['Shop']['quantity']) && $this->data['Shop']['quantity'] <= 0){
				$this->data['Shop']['quantity'] = 0;
				$this->data['Shop']['canview'] = 2;
			}
			
			elseif(isset($this->data['Shop']['id'])){
				$shop = $this->find("first", array("conditions" => array("Shop.id" =>$this->data['Shop']['id'])));
				if($shop['Shop']['canview'] == 2 && $this->data['Shop']['quantity'] > 0){
					
					$this->data['Shop']['canview'] = 1;
				}
			}
			
			
			return true;
		}



	}