<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/managepurchases'));
$this->end();
?>
<h2><span>Manage my Purchases</h2>
<div class="dashwrapper">
	<?php echo $this->element('dashboard/orderstatus', array('purchase' => true)); ?>
</div>
