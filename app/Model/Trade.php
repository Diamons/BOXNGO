<?php
	class Trade extends AppModel{
		public $useTable = false;
		public $belongsTo = array('User', 'Shop');
	}
