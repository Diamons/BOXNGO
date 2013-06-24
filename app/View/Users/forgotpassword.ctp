<?php 
$this->start('css');
	echo $this->Html->css('users/index');
$this->end();
?>

 <?php echo $this->Form->create("User", array('inputDefaults' => array('label' => false, 'div' => false))); ?>
 <?php echo $this->Form->input("User.id"); ?>
<div id="content" class="wrapper"> 
	<div class="row">
		<div class="two columns"></div>
		<div class="eight columns">
			<div class="modified_padding row">
				<div class="four columns">
					<label class="right inline"><b>Password</b></label>
				</div>
				<div class="eight columns">
					<?php echo $this->Form->input('User.passwordcreate', array('placeholder' => 'Password', 'type' => 'password')); ?>
				</div>
			</div>
			<div class="modified_padding row">
				<div class="four columns">
					<label class="right inline"><b>Confirm Password</b></label>
				</div>
				<div class="eight columns">
					<?php echo $this->Form->input('User.passwordconfirmation', array('placeholder' => 'Password', 'type'=>'password')); ?>
				</div>
			</div>
			<?php echo $this->Form->end("Change password"); ?>
		</div>
		<div class="two columns"></div>
	</div>
</div>