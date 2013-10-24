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
	<div id="questions"><div class="question_mark">?</div> 
	<div class="info_panel">It's free to get started selling today! Read more about <a href="/info/fees">Selling Fees</a></div></div>
	<div class="row">
		
		<div id="login_panel" style="padding-right: 100px;" class="col-xs-6 col-md-6">
		<?php echo $this->Form->create('User', array('class' => '', 'inputDefaults' => array('div'=>false, 'label'=>false))); ?>
			<h1 class="subheader">Login to Account</h1>
				<div style="text-align: right; margin: 0 143px 5px 0;">
					<a class="loginFacebookButton" data-redirect="users/facebookregister" href="#"></a>
				</div>
				<div class="modified_padding row">
					<div class="col-xs-4 col-md-4">
						<label class="right inline"><b>Email</b></label>
					</div>
					<div class="col-xs-8 col-md-8">
						<?php echo $this->Form->input('User.username', array('class' => 'form-control', 'placeholder' => 'Email Address')); ?>
					</div>
				</div>
				<div class="modified_padding row">
					<div class="col-xs-4 col-md-4">
						<label class="right inline"><b>Password</b></label>
					</div>
					<div class="col-xs-8 col-md-8">
						<?php echo $this->Form->input('User.password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
					</div>
				</div>
				<div class="modified_padding row">
					<div class="col-xs-4 col-md-4"></div>
					<div class="col-xs-8 col-md-8" style="text-align:right; font-size: 11px;"><a data-toggle="modal" href="#forgotpassword">Forgot your Password?</a></div>
				</div>
					<?php echo $this->Form->end('Login'); ?>
		</div>
		<div class="col-xs-6 col-md-6" id="register_panel">
		
			<img src="<?php echo $this->webroot;?>images/or.png" id="or" />
			<h1 class="subheader">Signup for <span class="logo">Box'<span class="emphasis">nGo</span></span></h1>
			<h5 class="subheader">BOX'NGO is an online buying, selling, and trading platform for sellers. Register today using your email address in order to become a part of the thriving community.</h5>

			<?php echo $this->Form->create('User', array('class'=>'', 'inputDefaults' => array('div'=>false, 'label'=>false))); ?>
				<div style="text-align: right; margin: 0 157px 5px 0;">
					<a class="loginFacebookButton" data-redirect="users/facebookregister" href="#"></a>
				</div>
				<div class="modified_padding row">
					<div class="col-xs-4 col-md-4">
						<label class="inline"><b>Email</b></label>
					</div>
					<div class="col-xs-8 col-md-8">
						<?php echo $this->Form->input('User.username', array('class' => 'form-control', 'placeholder' => 'Email Address')); ?>
					</div>
				</div>
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
					<?php echo $this->Form->input('User.accepttos', array('label' => 'I accept the', 'type' => 'checkbox', 'value' => '1')); ?>
					<a href="/info/tos">Terms of Service</a>
					<?php echo $this->Form->end('Register', array('class' => 'submitButton registerButton')); ?>
			</form>
		</div>
	</div>
</div>
 <div class="modal fade" id="forgotpassword">
 <?php echo $this->Form->create("User", array("action" => "forgotpassword")); ?>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Forgot your password?</h4>
        </div>
        <div class="modal-body">
			<p>Never fear, BOX'NGO is here! Simply enter the email address you used to signup below and we'll help you recover your account.</p>
			<p>
				
				<?php echo $this->Form->input("User.email", array("class" => "form-control", "type" => "text")); ?>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-large btn-default" data-dismiss="modal">Close</button>
          <?php echo $this->Form->end("Recover Password"); ?>
        </div>
      </div>
    </div>
  </div>
