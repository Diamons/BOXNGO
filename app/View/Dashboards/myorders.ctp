<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/managepurchases'));
$this->end();
?>
<h2>Manage my Orders</h2>
<div class="dashwrapper">
	<?php echo $this->element('dashboard/orderstatus', array('purchase' => false, 'purchases' => $orders)); ?>
</div>
