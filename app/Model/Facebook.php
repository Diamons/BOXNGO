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
			App::uses('Shop', 'Model');
			$shop = new Shop();
			$shop->recursive = 0;
			$short = $shop->read("permalink", $listingId);
			$productUrl = 'http://theboxngo.com/shops/viewlisting/'.$listingId.'/'.$short['Shop']['permalink'];
			$postUrl = 'https://graph.facebook.com/me/og.likes';
			$data = array('access_token' => $accessToken, 'object' => $productUrl);
			$results = $this->fb->api('me/theboxngo:favorite',
				'POST',
				array(
					'object' => $productUrl,
					'access_token' => $accessToken
				)
			);
			return $results;
		}

		public function forceScrape($url, $token){
			if(empty($token))
				$token = "BAABqaF6H4qMBAONHbhGvqvZBD0FGaPN2jEDd4WbSQOcGTh6gP0zWrGUwDxmqh4Tv5jnZBh03jwuaUPGo87qDgdyvPQkk5ZCIyrl8V8AnE7mGUM0TzNHVZAdc1GJK0gC5fFahIdntPPxS44TyKXyWCHTxUnLZC6lTntnDuzGLej0YUpiKui9tqHiFJZARZCMtI8pcUutib0lqlMvz2Y0Y7YFSsyVb14qgBMZD";

			$result = $this->httpSocket->post("http://developers.facebook.com/tools/lint", array('id' => urlencode($url), 'scrape' => true, 'access_token' => $token));;
		}
	}