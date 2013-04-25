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
<?php $this->end(); ?>
<script>
	$(function(){
		$("#about_boxngo div.columns").on("click", function(event){
			event.preventDefault();
			var link = $(this).find("a");
			$(".moreinfo").stop(true,true).slideUp();
			$(link.attr('href')).stop(true,true).slideDown();
			$("#about_boxngo span.enlarge").removeClass('active');
			$(this).find('span.enlarge').addClass('active');
		});
		
		$(".moreinfo .close").on("click", function(event){
			var tempId = $(this).parent().attr('id');
			$("#"+tempId).stop(true,true).slideUp();
			$("#about_boxngo span.enlarge").removeClass('active');
		});
	});
</script>
<div id="about_boxngo" class="wrapper modified_padding">
	<div class="row">
		<div class="four columns">
			<span class="typicn mobile enlarge"></span>
			<h1>Buy</h1>
			<div class="detail">Get next semester's textbook, get a new iPhone, handmade jewelry, and more straight from fellow classmates! It's easy, fast, and free!<br /><br />
			<a href="#buyinfo">How does it work?</a></div>
		</div>
		<div class="four columns">
			<span class="typicn tag enlarge"></span>
			<h1>Sell</h1>
			<div class="detail">Find students in and outside your college to sell your textbooks, calculators, iClickers, and more to! BOX'NGO helps you collect payments online easily, helping make sure you don't get scammed. 
			<a href="#sellinfo">How does it work?</a></div>
		</div>
		<div class="four columns">
			<span class="typicn sync enlarge"></span>
			<h1>Trade</h1>
			<div class="detail">Ever wanted to trade for stuff you want? Want to make a mix of cash and trade? We cover that too! BOX'NGO lets you arrange trades with students in your college with the click of a button. 
			<a href="#tradeinfo">How does it work?</a></div>
		</div>
	</div>
</div>

<div id="buyinfo" class="wrapper modified_padding moreinfo">
	<a href="#" class="close">Close</a>
	<div class="row">
		<div class="four columns">
			<span class="typicn directions enlarge"></span>
			<h4>Browse</h4>
			<div class="detail">
				Search through our listings for textbooks, handmade jewelry, electronics, and so much more!
			</div>
		</div>
		<div class="four columns">
			<span class="enlarge">$</span>
			<h4>Buy / Trade</h4>
			<div class="detail">
				Once you find something you like, simply pay for it online or choose to either pay in cash, or make a trade offer.
			</div>
		</div>
		<div class="four columns">
			<span class="enlarge typicn tick"></span>
			<h4>Receive Your Item</h4>
			<div class="detail">
				If you chose to buy your item, all you need to do is wait for the item to come in the mail or if you chose to trade or pay with cash, simply meet with the person and conduct the transaction!
			</div>
		</div>
	</div>
</div>

<div id="sellinfo" class="wrapper modified_padding moreinfo">
	<a href="#" class="close">Close</a>
	<div class="row">
		<div class="four columns">
			<span class="typicn list enlarge"></span>
			<h4>List</h4>
			<div class="detail">
				Quickly list your item within minutes by using our simple <a style="color: #0072ac;" href="/shops/shoplist">List an Item</a> form. For online credit card and debit card transactions, we charge a 10% fee.
			</div>
		</div>
		<div class="four columns">
			<span class="typicn forward enlarge"></span>
			<h4>Ship</h4>
			<div class="detail">
				Once you receive a notification someone has bought your item, package your stuff into a box and purchase a tracking number. Simply input the tracking number into BOX'NGO and you're set!
			</div>
		</div>
		<div class="four columns">
			<span class="enlarge typicn thumbsUp"></span>
			<h4>Get Paid</h4>
			<div class="detail">
				24 hours after the package is delivered, you'll have the funds directly transferred to your Paypal account or receive a check in the mail shortly afterwards.
			</div>
		</div>
	</div>
</div>

<div id="tradeinfo" class="wrapper modified_padding moreinfo">
	<a href="#" class="close">Close</a>
	<div class="row">
		<div class="four columns">
			<span class="typicn unknown enlarge"></span>
			<h4>Make an Offer</h4>
			<div class="detail">
				Send a message to the seller asking if they would be willing to make a trade for what you have to offer. Currently trades and offers are restricted to students attending the same university.
			</div>
		</div>
		<div class="four columns">
			<span class="typicn chat enlarge"></span>
			<h4>Arrange to Meet</h4>
			<div class="detail">
				Set up a time and place to meet that is convenient for both of you! We generally recommend this be a familar environment such as your college or school.
			</div>
		</div>
		<div class="four columns">
			<span class="enlarge sync typicn"></span>
			<h4>Make the Trade</h4>
			<div class="detail">
				Verify the details and make the trade! It's as simple as that!
			</div>
		</div>
	</div>
</div>

<div class="wrapper" id="content">
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