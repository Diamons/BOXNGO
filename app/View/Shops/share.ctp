<?php
	$this->start('css');
	echo $this->Html->css(array('users/paymentinfo', 'shops/share'));
	$this->end();
?>
<div class="clearfix wrapper" id="content">
	<div class="bearhello"></div>
	<div class="text">
		For an optimal experience, we recommend you <a href="#" id="facebookauthorize" onclick="login('<?php echo $this->webroot; ?>socials/sharefacebook/<?php echo $shoplink; ?>')">login to our Facebook application</a>. Some of the benefits include getting more views on your listing and making sure your friends can see the listings you have up for sale. If you're already logged in to Facebook, it takes 2 seconds to authorize the application.
		
		<div class="choices">
			
			<a href="javascript:void()" id="shareFacebook" class="choice" onclick="login('<?php echo $this->webroot; ?>socials/sharefacebook/<?php echo $shoplink; ?>')">Login with Facebook</a>
			<div style="display:none;" id="facebookLinked">Your account has successfully been linked with your Facebook account!</div>
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $shoplink; ?>" class="choice">Continue to your Listing</a>
		</div>
	</div>
</div>	