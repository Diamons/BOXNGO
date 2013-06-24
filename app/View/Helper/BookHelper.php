<?php
	class BookHelper extends AppHelper{
		
		public function getImage($isbn=NULL){
			return "<img src='http://covers.openlibrary.org/b/isbn/".$isbn."-L.jpg' />";
		}
	}