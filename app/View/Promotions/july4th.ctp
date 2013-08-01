<?php
$this->start('css');
echo $this->Html->css(array('pages/main', 'promotions/july4th'));
$this->end();
?>
<div id="content" class="wrapper">
	<div class="clearfix about">
		<h1>Get 10% Off our July 4th Collection!</h1>
		<div class="promotion_info">
			July 4th marks America's birthday and we're here to celebrate! Through July 4th (up to 11:59:59 GMT -8), get 10% off if you purchase any of the following items! 
			<p><b>Use coupon code 'july4th'.</b></p>
			<div id="listings">
				<?php echo $this->element('four_columns_collections', array('listings' => $collection['CollectionItem'])); ?>
			</div>	
		</div>
	</div>	
</div>
