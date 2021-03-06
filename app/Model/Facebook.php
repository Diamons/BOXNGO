<?php
	class Facebook extends AppModel{
		
		public $useTable = false;
		public $httpSocket = NULL;
		
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
			/*App::uses('Shop', 'Model');
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
			return $results;*/
			return true;
		}

		public function removePost($postId){
			if(!empty($postId)){
				$response = $this->fb->api(
				  '/'.$postId,
				  'DELETE'
				);
			}
		}

		public function forceScrape($url){
			$url = urlencode($url);;
			$result = $this->httpSocket->post("http://developers.facebook.com/tools/debug/og/object?q=".$url);
		}
	}
