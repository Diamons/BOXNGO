<h1>Assign Categories to (<?php echo count($listings); ?>) Listings</h1>
<?php echo $this->Form->create('Shop', array('inputDefaults' => array('label' => false, 'div' => false))); ?>
<?php for($i = 0; $i < count($listings); $i++){ ?>
	<div class="row">
		<div class="eight columns">
			<?php echo nl2br(h($listings[$i]['Shop']['name'])); ?>
		</div>
		<div class="four columns">
			<?php
				echo $this->Form->input('Shop.'.$i.'.id', array('value' => $listings[$i]['Shop']['id']));
				echo $this->Form->input('Shop.'.$i.'.category_id', array('empty' => 'None', 'options' => $categories));
			?>
		</div>
	</div>
<?php } ?>
<?php echo $this->Form->end("Modify Items"); ?>