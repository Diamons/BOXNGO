<?php
	class CronShell extends AppShell {
		public $uses = array('Order', 'Shop');
	    public function main() {
	        $this->out('Hello world.');
	    }

	    public function sellerReminder(){
			$orders = $this->Order->find("all",array("conditions" => array("Order.status" => "pending", "DATEDIFF(CURDATE(), DATE(Order.created)) <" => 4)));
			for($i = 0; $i < count($orders); $i++){
				$expire = new DateTime($orders[$i]['Order']['created'], new DateTimeZone('America/New_York'));
				$expire = $expire->modify('+4 day');
				$image = $this->Shop->Image->getShopImage($orders[$i]['Shop']['id']);
				parent::sendEmail($orders[$i]['User']['username'], "BOX'NGO :: Important reminder that you have an order awaiting your acceptance!", "remindseller", array("link" => $orders[$i]['Shop']['full_url'], "imageUrl" => $image['Image']['url'], "totalPrice" => $orders[$i]['Order']['totalPrice'], "name" => $orders[$i]['Shop']['name'], "expire" => $expire->format('Y-m-d h:i:s A')));
				parent::sendEmail("shahruk@theboxngo.com", "BOX'NGO :: Important reminder that you have an order awaiting your acceptance!", "remindseller", array("link" => $orders[$i]['Shop']['full_url'], "imageUrl" => $image['Image']['url'], "totalPrice" => $orders[$i]['Order']['totalPrice'], "name" => $orders[$i]['Shop']['name'], "expire" => $expire->format('Y-m-d h:i:s A')));
			}
	    }
		
		public function remindTest(){
			$orders = $this->Order->find("all",array("conditions" => array("Order.status" => "pending", "DATEDIFF(CURDATE(), DATE(Order.created)) <" => 4)));
			$this->out(count($orders));
			for($i = 0; $i < count($orders); $i++){
				
				$expire = new DateTime($orders[$i]['Order']['created'], new DateTimeZone('America/New_York'));
				$expire = $expire->modify('+4 day');
				$image = $this->Shop->Image->getShopImage($orders[$i]['Shop']['id']);
				//parent::sendEmail($orders[$i]['User']['username'], "BOX'NGO :: Important reminder that you have an order awaiting your acceptance!", "remindseller", array("link" => $orders[$i]['Shop']['full_url'], "imageUrl" => $image['Image']['url'], "totalPrice" => $orders[$i]['Order']['totalPrice'], "name" => $orders[$i]['Shop']['name'], "expire" => $expire->format('Y-m-d h:i:s A')));
				//parent::sendEmail("shahruk@theboxngo.com", "BOX'NGO :: Important reminder that you have an order awaiting your acceptance!", "remindseller", array("link" => $orders[$i]['Shop']['full_url'], "imageUrl" => $image['Image']['url'], "totalPrice" => $orders[$i]['Order']['totalPrice'], "name" => $orders[$i]['Shop']['name'], "expire" => $expire->format('Y-m-d h:i:s A')));
				$this->out($orders[$i]['User']['username']);
			}
	    }
	}