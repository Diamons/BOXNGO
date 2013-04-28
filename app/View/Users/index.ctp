<?php 
$this->start('css');
echo $this->Html->css('users/index');
$this->end();
?>
<?php $this->start('scriptBottom');?>
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
						url: getDomain()+'users/facebook',
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
<?php $this->end(); ?>

<div class="wrapper" id="content">
	<div style="border:6px solid #f0f8e8; background: #e7fad4; min-height: 100px; margin-bottom: 10px;" id="questions"><div style="line-height: 120px; font-size:64px;" class="question">?</div> <div class="panel">Curious? Check out the How It Works page for further details!</div></div>
	<div>
		<?php echo $this->Form->create('User', array('class' => '', 'inputDefaults' => array('div'=>false, 'label'=>false))); ?>
		<div style="padding-right: 100px;" class="six columns">
			<h1 class="subheader">Login to Account</h1>
				<div style="text-align: right; margin: 0 103px 5px 0;">
					<a class="loginFacebookButton" data-redirect="users/facebookregister" href="#"></a>
				</div>
				<div class="modified_padding row">
					<div class="four columns">
						<label class="right inline"><b>Email</b></label>
					</div>
					<div class="eight columns">
						<?php echo $this->Form->input('User.username', array('placeholder' => 'Email Address')); ?>
					</div>
				</div>
				<div class="modified_padding row">
					<div class="four columns">
						<label class="right inline"><b>Password</b></label>
					</div>
					<div class="eight columns">
						<?php echo $this->Form->input('User.password', array('placeholder' => 'Password')); ?>
					</div>
				</div>
				<div class="modified_padding row">
					<div class="four columns"></div>
					<div class="eight columns" style="text-align:right; font-size: 11px;"><a data-reveal-id="forgotpassword" href="#">Forgot your Password?</a></div>
				</div>
				<div class="modified_padding row">
					<div class="four columns">
					</div>
					<div class="eight columns">
						<?php echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => 'Keep me logged in')); ?>
					</div>
				</div>
					<?php echo $this->Form->end('Login'); ?>
		</div>
		<div class="six columns" id="register_panel">
		
			<img src="<?php echo $this->webroot;?>images/or.png" id="or" />
			<h1 class="subheader">Signup for <span class="logo">Box'<span class="emphasis">nGo</span></span></h1>
			<h5 class="subheader">BOX'NGO is an online buying, selling, and trading platform for sellers. Register today using your email address in order to become a part of the thriving community.</h5>

			<?php echo $this->Form->create('User', array('class'=>'', 'inputDefaults' => array('div'=>false, 'label'=>false))); ?>
				<div style="text-align: right; margin: 0 114px 5px 0;">
					<a class="loginFacebookButton" data-redirect="users/facebookregister" href="#"></a>
				</div>
				<div class="modified_padding row">
					<div class="four columns">
						<label class="right inline"><b>Email</b></label>
					</div>
					<div class="eight columns">
						<?php echo $this->Form->input('User.username', array('placeholder' => 'Email Address')); ?>
					</div>
				</div>
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
					<?php echo $this->Form->input('User.accepttos', array('label' => 'I accept the', 'type' => 'checkbox', 'value' => '1')); ?>
					<a href="/info/tos">Terms of Service</a>
					<?php echo $this->Form->end('Register', array('class' => 'submitButton registerButton')); ?>
			</form>
		</div>
	</div>
</div>

	<div id="forgotpassword" class="reveal-modal small">
		<h1>Forgot your password?</h1>
		<p class="lead">Never fear, BOX'NGO is here! Simply enter the email address you used to signup below and we'll help you recover your account.</p>
		<p>
			<?php echo $this->Form->create("User", array("action" => "forgotpassword")); ?>
			<?php echo $this->Form->input("User.email", array("type" => "text")); ?>
			<?php echo $this->Form->end("Recover Password"); ?>
	  </p>
	  <a class="close-reveal-modal">&#215;</a>
	</div>