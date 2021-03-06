<?php $this->start('css');
echo $this->Html->css('users/paymentinfo');
$this->end();
$this->start('scriptBottom');
echo $this->Html->script('users/paymentinfo');
$this->end();
?>
<div class="clearfix wrapper" id="content">
	<h1>Manage Payment Information</h1>
	<div class="text">
		Hey there user! So before you can start selling, we just need to collect a few small pieces of information from you. Here at BOX'NGO, we offer you the choice of getting paid via Paypal or Check - whichever is more convenient for you.
		
		<div class="paypal">
			Have a free Paypal account? Get paid within 24 - 48 hours after you ship your stuff directly to your account! Wow that's fast.
		</div>
		<div class="check">
			Get a check mailed to you once every 2 weeks! Great for those without a Paypal account! Get paid for your sales every two weeks minus postage.
		</div>
	</div>
	<div class="choices">
		<img onclick="$('#UserPaymentPaypal').attr('checked', true);$('#checkChoice').slideUp(); $('#paypalChoice, #UserPaymentinfoForm input[type=\'submit\']').slideDown();" class="paypal_large choice" src="/images/payments/paypal_large.png" />
		<img onclick="$('#UserPaymentCheck').attr('checked', true);$('#paypalChoice').slideUp(); $('#checkChoice, #UserPaymentinfoForm input[type=\'submit\']').slideDown();" class="check_large choice" src="/images/payments/check_large.png" />
		<?php echo $this->Form->create("User", array("class" => "form-horizontal", "inputDefaults" => array("div" => false, "label" => false))); ?>
		<div id="checkmarks">
			<?php
				$options=array('paypal'=>'Paypal','check'=>'Check');
				echo $this->Form->radio('User.payment', $options);
			?>
		</div>
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<div id="paypalChoice">
					<div class="form-group">
						<div class="col-xs-4 col-md-4">Paypal E-mail Address</div><div class="col-xs-8 col-md-8"><?php echo $this->Form->input("User.paypal", array("class" => "form-control", "required" => false)); ?></div>
					</div>
				</div>
				<div id="checkChoice">
					<div class="form-group">
						<div class="col-xs-4 col-md-4">First Name</div><div class="col-xs-8 col-md-8"><?php echo $this->Form->input("User.first_name", array("class" => "form-control")); ?></div>
					</div>
					<div class="form-group">
						<div class="col-xs-4 col-md-4">Last Name</div><div class="col-xs-8 col-md-8"><?php echo $this->Form->input("User.last_name", array("class" => "form-control")); ?></div>
					</div>
					<div class="form-group">
						<div class="col-xs-4 col-md-4">Street Address</div><div class="col-xs-8 col-md-8"><?php echo $this->Form->input("User.streetAddress", array("class" => "form-control")); ?></div>
					</div>
					<div class="form-group">
						<div class="col-xs-2 col-md-2">City</div><div class="col-xs-2 col-md-2"><?php echo $this->Form->input("User.city", array("class" => "form-control")); ?></div>
						<div class="col-xs-2 col-md-2">State</div><div class="col-xs-2 col-md-2"><?php echo $this->Form->input("User.state", array("class" => "form-control")); ?></div>
						<div class="col-xs-2 col-md-2">Zip Code</div><div class="col-xs-2 col-md-2"><?php echo $this->Form->input("User.zipcode", array("class" => "form-control", "type" => "text")); ?></div>
					</div>
				</div>
			</div>
		</div>
		<?php 
		if(empty($this->request->data)){ echo $this->Form->end("Save Payment Information"); } else if(!empty($this->request->data)){ echo $this->Form->end("Update Payment Information"); }?>
	</div>
</div>
