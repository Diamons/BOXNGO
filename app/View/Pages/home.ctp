<?php $this->start('scriptBottom'); ?>
<script>
	$(function(){
		$("a.loginFacebookButton").on("click", function(event){
			event.preventDefault();	
			var redirectUrl = $(this).data('redirect');
			FB.getLoginStatus(function(response) {
			  if (response.status === 'connected') {
			  } else if (response.status === 'not_authorized') {
				// not_authorized
				login();
			  } else {
				// not_logged_in
				login();
			  }
			});
			
			FB.login(function(response) {
				
				if (response.authResponse) {
					var date = new Date();
					var time = 2;
					date.setTime(date.getTime() + (time * 60 * 1000));
					document.cookie='fbAccess='+response.authResponse.accessToken+'; expires='+date.toUTCString()+';';
					$.ajax({
						data: {userID: response.authResponse.userID},
						url: 'http://theboxngo.com/users/facebook',
						success: function(data){
							window.top.location = getDomain()+redirectUrl+'?fb='+response.authResponse.userID;
						}
					});
					
				}
			});
			
			FB.Event.subscribe('auth.login', function (response) {
			  window.top.location = getDomain()+redirectUrl+'?fb='+response.authResponse.userID;
			});
		});
	});
</script>
<?php $this->end();
$this->start('css');
echo $this->Html->css(array('searches/search', 'pages/main'));
$this->end();
?>
<div id="content">
	<div class="wrapper">
		<div id="boxngo_intro">
			<h1>Buy. Sell. Trade.</h1>
			<h2>Connect with students from all over the world and your own local campus. Buy from others online, sell your stuff to make money quickly and easily, and trade with other students from your campus all through <img style="margin-bottom:-5px;" src="/logo.png" alt="BOX'NGO">.</h2>
			<h2>It's quick, easy, and FREE!</h2>
		</div>
		<div id="welcome_container">
			<?php echo $this->Form->create('User', array('class'=>'custom', 'url' => '/users/', 'inputDefaults' => array('div'=>false, 'label'=>false))); ?>
				<div style="text-align: right; margin: 0 100px 5px 0;">
					<a class="loginFacebookButton" data-redirect="users/facebookregister" href="#"></a>
				</div>
						<?php echo $this->Form->input('User.username', array('placeholder' => 'Enter your @EDU Email Address')); ?>
						<?php echo $this->Form->input('User.passwordcreate', array('placeholder' => 'Password', 'type' => 'password')); ?>
						<?php echo $this->Form->input('User.passwordconfirmation', array('placeholder' => 'Password', 'type'=>'password')); ?>
					<?php echo $this->Form->input('User.accepttos', array('label' => 'I accept the', 'type' => 'checkbox', 'value' => '1')); ?>
					<a href="/info/tos">Terms of Service</a>
					<?php echo $this->Form->end('Register', array('class' => 'submitButton registerButton')); ?>
		</div>
	</div>
</div>
<div class="features wrapper">
	<div class="row">
		<div class="four columns">
			<div>
				<i class="icon-credit-card"></i> <h2>Hassle Free Shopping</h2>
			</div>
				It's as easy as finding something you like, paying via <a href="https://stripe.com/gallery">Stripe</a>, and receiving your item. You can shop on BOX'NGO knowing that we're here to help take care of any issues that may arise.
		</div>
		<div class="four columns">
			<div>
				<i class="icon-heart"></i> <h2>Selling Made Easy</h2>
			</div>
				It takes less than 2 minutes to get started selling to your fellow students. You can even trade in person with students from your school!
		</div>
		<div class="four columns">
			<div>
				<i class="icon-cogs"></i> <h2>Low Selling Fees</h2>
			</div>
				BOX'NGO charges a flat 10% fee &mdash; lower than most other selling platforms to the seller, not the buyer. You receive 90% of the payment when someone decides to buy online. Only pay when you make a sale, and best of all, cash and trade transactions are 100% free.
		</div>
	</div>
</div>