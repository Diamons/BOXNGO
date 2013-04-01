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
			$productUrl = 'http://theboxngo.com/shops/viewlisting/'.$listingId;
			$postUrl = 'https://graph.facebook.com/me/og.likes';
			$data = array('access_token' => $accessToken, 'object' => $productUrl);
			$results = $this->httpSocket->post($postUrl, $data);
			$results .= $this->httpSocket->get('https://graph.facebook.com/me/theboxngo:favorite&access_token='.$accessToken.'&method=POST&
gifts_product='.$productUrl);
			print_r($results);
			return $results;
		}
	}