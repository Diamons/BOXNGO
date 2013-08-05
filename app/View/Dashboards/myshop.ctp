<?php $this->start('css');
	echo $this->Html->css(array('searches/search'));
$this->end(); ?>	
<?php echo $this->element('four_columns_listings', array('listings' => $listings)); ?>