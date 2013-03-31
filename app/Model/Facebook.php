<?php
	class Facebook extends AppModel{
		
		var $useTable = false;
		var $httpSocket = NULL;
		
		public function __construct($id = false, $table = null, $ds = null) {
			App::uses('HttpSocket', 'Network/Http');
			$this->httpSocket = new HttpSocket();
			parent::__construct($id, $table, $ds);

			App::import('Vendor', 'Facebook/FacebookLibrary');
			Configure::load('facebook');
			$this->fb = new FacebookLibrary(Configure::read('Facebook'));

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

			//Gotta scrape first, Heroku workaround for Custom Types
			$results2 = $this->httpSocket->post('https://graph.facebook.com/?id='.$productUrl.'&scrape=true');
			debug($results2);
			debug('https://graph.facebook.com/?id='.$productUrl.'&scrape=true');
			$results = $this->httpSocket->post($postUrl, $data);
			$results2 = $this->fb->api('/me/theboxngo:favorite',
				'POST',
				array(
					'listing' => $productUrl,
					'access_token' => $accessToken
				)
			);
			return $results;
		}
	}