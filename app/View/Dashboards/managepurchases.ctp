<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/managepurchases'));
$this->end();
?>
<div id="dashmenu"><span>Manage my Purchases</span></div>
<div class="dashwrapper">
	<?php echo $this->element('dashboard/orderstatus'); ?>
</div>