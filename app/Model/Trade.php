<?php
	class Trade extends AppModel{
		
		public $belongsTo = array('User', 'Shop');
	}
