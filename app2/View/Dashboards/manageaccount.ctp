<?php
$this->start('css');
	echo $this->Html->css(array('dashboard/manageaccount'));
$this->end();
$this->start('scriptBottom');
	echo $this->Html->script(array('//api.filepicker.io/v1/filepicker.js', 'dashboard/manageaccount'));
$this->end();
?>
<?php echo $this->Form->create("User", array("inputDefaults" => array("label" => false, "div" => false))); ?>
<?php echo $this->Form->hidden("User.id"); ?>
	<div class="row">
		<div class="four columns">
			<b>Display Name</b>
			<span class="detail">
				How do you want other users to see you on BOX'NGO?
			</span>
		</div>
		<div class="eight columns">
			<?php echo $this->Form->input("User.display_name"); ?>
		</div>
	</div>
	<div class="row">
	<div class="four columns">
		<b>Profile Picture</b>
		<span class="detail">
			An image to represent you on BOX'NGO.
		</span>
	</div>
	<div class="eight columns">
		<div id="uploadImages">
				<a href="#" id="upload">Upload Profile Picture</a>
				<?php echo $this->Form->textarea("User.profilepic"); ?>
				<span class="detail">Once you upload your picture, click Save Info.</span>
				<div id="editor"></div>
			</div>
	</div>
</div>
<?php echo $this->Form->end("Save Info"); ?>