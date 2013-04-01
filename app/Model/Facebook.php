<?php
	class Facebook extends AppModel{
		
		var $useTable = false;
		var $httpSocket = NULL;
		
		public function __construct($id = false, $table = null, $ds = null) {
			App::uses('HttpSocket', 'Network/Http');
			$this->httpSocket = new HttpSocket();
			parent::__construct($id, $table, $ds);
			
		}
		public function shareListing($name,$url,$fbId,$accessToken,$message=NULL, $imageUrl=NULL){
			$message = 'I just listed '.$name.' for sale on BOX\'NGO! Check it out!';
			$postUrl = 'https://graph.facebook.com/'.$fbId.'/feed?picture='.urlencode($imageUrl).'&link='.urlencode($url).'&name='.$name.'&message='.urlencode($message).'&access_token='. $accessToken;
			$results = $this->httpSocket->post($postUrl);
			return $results;
		}
		
		public function favoriteListing($listingId,$accessToken){
			$postUrl = 'https://graph.facebook.com/me/og.likes';
			$data = array('access_token' => $accessToken, 'gifts_product' => 'http://theboxngo.com/shops/viewlisting/'.$listingId, 'object' => 'http://theboxngo.com/shops/viewlisting/'.$listingId);
			$results = $this->httpSocket->post($postUrl, $data);
			print_r($results);
			die();
			return $results;
		}
	}