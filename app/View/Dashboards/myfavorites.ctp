<?php $this->start('css');
echo $this->Html->css(array('pages/main', 'promotions/july4th'));
$this->end(); ?>	
<?php if(!empty($favorites)){ ?>
	<div id="listings">
		<?php echo $this->element('four_columns_collections', array('listings' => $favorites)); ?>
	</div>
<?php } else { ?>
	<div class="noresults">You have no favorites? :( Start searching and go add some!</div>
<?php } ?>