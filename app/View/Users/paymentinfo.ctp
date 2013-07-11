<?php $this->start('css');
echo $this->Html->css('users/paymentinfo');
$this->end();
$this->start('scriptBottom');
echo $this->Html->script('users/paymentinfo');
$this->end();
?>
<div class="clearfix wrapper" id="content">
	<div class="bearhello"></div>
	<div class="text">
		Hey there user! So before you can start selling, we just need to collect a few small pieces of information from you. Here at BOX'NGO, we offer you the choice of getting paid via Paypal or Check - whichever is more convenient for you.
		
		<div class="paypal">
			Have a free Paypal account? Get paid within 24 - 48 hours after you ship your stuff directly to your account! Wow that's fast.
		</div>
		<div class="check">
			Get a check mailed to you once every 2 weeks! Great for those without a Paypal account! 
		</div>
		
		<div class="choices">
			<img onclick="$('#UserPaymentPaypal').attr('checked', true);$('#checkChoice').slideUp(); $('#paypalChoice, #UserPaymentinfoForm input[type=\'submit\']').slideDown();" class="paypal_large choice" src="/images/payments/paypal_large.png" />
			<img onclick="$('#UserPaymentCheck').attr('checked', true);$('#paypalChoice').slideUp(); $('#checkChoice, #UserPaymentinfoForm input[type=\'submit\']').slideDown();" class="check_large choice" src="/images/payments/check_large.png" />
			<?php echo $this->Form->create("User", array("inputDefaults" => array("div" => false, "label" => false))); ?>
			<div id="checkmarks">
				<?php
					$options=array('paypal'=>'Paypal','check'=>'Check');
					echo $this->Form->radio('User.payment',$options);
				?>
			</div>
			<div id="paypalChoice" class="row">
				<div class="four columns">Paypal E-mail Address</div><div class="eight columns"><?php echo $this->Form->input("User.paypal", array("required" => false)); ?></div>
			</div>
			<div id="checkChoice">
				<div class="row">
					<div class="four columns">First Name</div><div class="eight columns"><?php echo $this->Form->input("User.first_name"); ?></div>
				</div>
				<div class="row">
					<div class="four columns">Last Name</div><div class="eight columns"><?php echo $this->Form->input("User.last_name"); ?></div>
				</div>
				<div class="row">
					<div class="four columns">Street Address</div><div class="eight columns"><?php echo $this->Form->input("User.streetAddress"); ?></div>
				</div>
				<div class="row">
					<div class="two columns">City</div><div class="two columns"><?php echo $this->Form->input("User.city"); ?></div>
					<div class="two columns">State</div><div class="two columns"><?php echo $this->Form->input("User.state"); ?></div>
					<div class="two columns">Zip Code</div><div class="two columns"><?php echo $this->Form->input("User.zipcode", array("type" => "text")); ?></div>
				</div>
			</div>
			<?php 
			if(empty($this->request->data)){ echo $this->Form->end("Save Payment Information"); } else if(!empty($this->request->data)){ echo $this->Form->end("Update Payment Information"); }?>
		</div>
	</div>
</div>