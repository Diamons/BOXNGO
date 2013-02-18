<?php
	class Trade extends AppModel{
		
		var $belongsTo = array('User');
		var $hasOne = array('Shop');
	}