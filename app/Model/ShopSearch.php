<?php
	class ShopSearch extends AppModel{
		public $useDbConfig = 'index';
		public $actsAs = array('Elastic.Indexable');
		public $_mapping = array(
			'id' => array('type' => 'integer'),
			'user_id' => array('type' => 'integer'),
			'image' => array('type' => 'string'),
			'name' => array('type' => 'string'),
			'description' => array('type' => 'string'),
			'full_url' => array('type' => 'string'),
			'display_name' => array('type' => 'string'),
			'created' => array('type' => 'datetime'),
			'modified' => array('type' => 'datetime')
		);

		public function elasticMapping() {
			return $this->_mapping;
		}
	}
