<?php
	class Comment extends AppModel{
		public $belongsTo = array('Shop', 'User');
	}