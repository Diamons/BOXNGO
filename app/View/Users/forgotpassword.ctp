<?php 
$this->start('css');
	echo $this->Html->css('users/index');
$this->end();
?>

 <?php echo $this->Form->create("User", array('inputDefaults' => array('label' => false, 'div' => false))); ?>
 <?php echo $this->Form->input("User.id"); ?>
<div id="content" class="wrapper"> 
	<div class="row">
		<div class="col-xs-2 col-md-2"></div>
		<div class="col-xs-8 col-md-8">
			<div class="modified_padding row">
				<div class="col-xs-4 col-md-4">
					<label class="right inline"><b>Password</b></label>
				</div>
				<div class="col-xs-8 col-md-8">
					<?php echo $this->Form->input('User.passwordcreate', array('class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password')); ?>
				</div>
			</div>
			<div class="modified_padding row">
				<div class="col-xs-4 col-md-4">
					<label class="right inline"><b>Confirm Password</b></label>
				</div>
				<div class="col-xs-8 col-md-8">
					<?php echo $this->Form->input('User.passwordconfirmation', array('class' => 'form-control', 'placeholder' => 'Password', 'type'=>'password')); ?>
				</div>
			</div>
			<?php echo $this->Form->end("Change password"); ?>
		</div>
		<div class="col-xs-2 col-md-2"></div>
	</div>
</div>
