<?php
	class Trade extends AppModel{
		
		var $belongsTo = array('User', 'Shop');
	}