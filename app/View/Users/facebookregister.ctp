<?php $this->start('css');
echo $this->Html->css('users/facebookregister');
$this->end(); 
?>
<div id="content" class="wrapper">
	<div id="textContent">
		Hey fellow member, thanks for signing up using Facebook! We just need your email to get you started on BOX'NGO!
		<?php echo $this->Form->create(array('inputDefaults' => array('div' => false, 'label' => false))); ?>
			<?php echo $this->Form->input('User.username', array('placeholder' => 'E-mail address')); ?>
		<?php echo $this->Form->end('Register'); ?>
	</div>
</div>