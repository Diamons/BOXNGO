<?php
	class ReviewsController extends AppController{
		public function feedback($orderId){
			$order = $this->Order->read(NULL, $orderId);
			$this->set("order", $order);
		}
	}
