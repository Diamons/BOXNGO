<?php
	class Collection extends Category{
		//public $hasMany = array('Shop');
		var $order = "Collection.display_name ASC";
		var $hasMany = array('CollectionItem');
	}