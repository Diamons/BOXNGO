<?php
	class Image extends AppModel{
		
		//Shops controller, shoplist
		public function saveImages($images, $id){
			//Semicolon delimiter
			$this->clearImages($id);
			$images = preg_split('/;/', $images);
			$imageData = array();	
			for($i = 0; $i < count($images); $i++){
				if(!empty($images[$i])){
					$this->create();
					if(!filter_var($images[$i], FILTER_VALIDATE_URL));
					else{
						$imageData['Image']['url'] = $images[$i];	
						$imageData['Image']['shop_id'] = $id;
						if($this->save($imageData));
					}
				
				}
			}
		}

		public function getShopImage($shopId=NULL){
			return $this->find("first", array("conditions" => array("Image.shop_id" => $shopId)));
		}
		
		public function clearImages($shopId){
			$this->deleteAll(array("Image.shop_id" => $shopId));
		}
	}