<?php
$this->start('css');
	echo $this->Html->css(array());
$this->end();
$this->start('scriptBottom');
	echo $this->Html->script(array('//api.filepicker.io/v1/filepicker.js', 'dashboard/manageaccount'));
$this->end();
?>

<style>
	#UserProfilepic {
		display: none;
	}
	
	.form-group{
		padding-bottom: 20px;
		margin-bottom: 20px;
		border-bottom: 1px solid #EEE;
	}
</style>
<?php echo $this->Form->create("User", array("class" => "form-horizontal", "inputDefaults" => array("label" => false, "div" => false))); ?>
<?php echo $this->Form->hidden("User.id"); ?>
	<div class="form-group">
		<div class="col-xs-4 col-md-4">
			<b>Display Name</b>
			<div class="detail">
				How do you want other users to see you on BOX'NGO?
			</div>
		</div>
		<div class="col-xs-8 col-md-8">
			<?php echo $this->Form->input("User.display_name", array("class" => "form-control")); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-4 col-md-4">
			<b>City</b>
				<div class="detail">
					Which city will you be selling from?
				</div>
		</div>
		<div class="col-xs-8 col-md-8">
			<?php echo $this->Form->input("User.seller_city", array("class" => "form-control")); ?>
		</div>
	</div>
	<div id="stateSelect" class="form-group">
		<div class="col-xs-4 col-md-4">
			<b>State</b>
				<div class="detail">
					Which state will you be selling from? <small>(optional)</small>
				</div>
		</div>
		<div class="col-xs-8 col-md-8">
			<?php echo $this->Country->stateSelect('User.seller_state', array('class' => 'form-control', 'default' => $auth['seller_state'], 'label' => false)); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-4 col-md-4">
			<b>Country</b>
				<div class="detail">
					Which country are you located in?
				</div>
		</div>
		<div class="col-xs-8 col-md-8">
			<?php echo $this->Country->countrySelect('User.seller_country', array('class' => 'form-control', 'default' => $auth['seller_country'], 'label' => false)); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-4 col-md-4">
			<b>Profile Picture</b>
				<div class="detail">
					An image to represent you on BOX'NGO.
				</div>
		</div>
		<div class="col-xs-8 col-md-8">
			<div id="uploadImages">
					<a href="#" id="upload">Upload Profile Picture</a>
					<?php echo $this->Form->textarea("User.profilepic", array("class" => "form-control")); ?>
					<div class="detail">Once you upload your picture, click Save Info.</div>
					<div id="editor"></div>
				</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-4 col-md-4">
			<b>Small Description</b>
			<div class="detail">
				A few words to describe you on your profile page.
			</div>
		</div>
		<div class="col-xs-8 col-md-8">
			<?php echo $this->Form->textarea('User.profile_info', array("class" => "form-control")); ?>
			<div class="countdown"></div>
			<?php echo $this->Form->error('User.profile_info'); ?>
		</div>
	</div>
<?php echo $this->Form->end("Save Info"); ?>
