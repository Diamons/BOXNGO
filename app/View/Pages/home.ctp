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
<?php $this->end();
$this->start('css');
echo $this->Html->css(array('searches/search', 'pages/main_home'));
$this->end();
$this->start('meta'); ?>

<meta name="title" content="BOX'NGO - Online selling Made Easy" />
<meta name="keywords" content="buy, sell, trade, buying, selling, trading" />
<meta name="description" content="Buy, sell, and trade in the online marketplace that makes online commerce convenient. BOX'NGO makes buying, selling, and trading online easier than ever before." />

<?php $this->end();
?>
<div class="clearfix" id="content">
	<div class="wrapper">
		<div id="boxngo_intro">
			<h1>A Simpler, Easier Marketplace</h1>
			<div class="row feature">
				<div class="two columns">
					<i class="icon-credit-card"></i> 
				</div>
				<div class="ten columns">
					<h2>One Simple 10% Selling Fee</h2>
					It doesn't get any easier than earning 90% of your selling price. We believe sellers shouldn't have to try and figure out PayPal fees, credit card transaction fees, listing fees, and any other fees most other online selling platforms charge their users. With BOX'NGO, simply list your stuff and receive 90% of your sale price. It's as simple as that.
				</div>
			</div>
			<div class="row feature">
				<div class="two columns">
					<i class="icon-bolt"></i> 
				</div>
				<div class="ten columns">
					<h2>Quick and Easy Payments - Check or PayPal</h2>
					One thing sellers really hate is having to wait days to get your payment. With BOX'NGO, we make getting paid quick and easy for our sellers. When getting paid via PayPal, we simply disburse 90% of the sale into your PayPal account 24 hours after you post a tracking code. If you choose to get paid via check, we mail a check every two weeks for 90% of the sales in those two weeks minus 46 cents for postage. No fees, no waits, just quick and easy.
				</div>
			</div>
			<div class="row feature">
				<div class="two columns">
					<i class="icon-reorder"></i> 
				</div>
				<div class="ten columns">
					<h2>Quick and Easy Listing Process</h2>
					Our listing process takes 20 - 30 seconds to fill and complete. With just a few fields, you can be on your way to selling online. We believe selling online should be an easy frictionless process and an easy listing form is just one way to achieve that.
				</div>
			</div>
		</div>
		<div id="welcome_container">
			<?php echo $this->Form->create('User', array('class'=>'', 'url' => '/users/', 'inputDefaults' => array('div'=>false, 'label'=>false))); ?>
				<div style="text-align: right; margin: 0 100px 5px 0;">
					<a class="loginFacebookButton" data-redirect="users/facebookregister" href="#"></a>
				</div>
						<?php echo $this->Form->input('User.username', array('placeholder' => 'Enter your Email Address')); ?>
						<?php echo $this->Form->input('User.passwordcreate', array('placeholder' => 'Password', 'type' => 'password')); ?>
						<?php echo $this->Form->input('User.passwordconfirmation', array('placeholder' => 'Confirm Password', 'type'=>'password')); ?>
					<?php echo $this->Form->input('User.accepttos', array('label' => 'I accept the', 'type' => 'checkbox', 'value' => '1')); ?>
					<a href="/info/tos">Terms of Service</a>
					<?php echo $this->Form->end('Register', array('class' => 'submitButton registerButton')); ?>
					<a href="/search" id="browse"><i class="icon-arrow-right"></i>Browse Listings</a>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="listings">
		<?php if(!empty($listings)): ?>
			<?php 
				for($i = 0; $i < count($listings); $i++):
					if($i == 0 || $i % 4 == 0): ?>
						<div class="row">
					<?php endif; ?>
						<div class="three columns">
							<div class="listing">
								<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $listings[$i]['Shop']['id'];?>/<?php echo $listings[$i]['Shop']['permalink']; ?>">
								<?php if(!empty($listings[$i]['Image'][0]['url'])){?>
								<img src="<?php echo $listings[$i]['Image'][0]['url']; ?>/convert?w=250&h=205&fit=crop" class="image" />
								<?php } else { ?>
								<div class="image"></div>
								<?php } ?>
								</a>
								<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($listings[$i]['Shop']['id']));?>/<?php echo $listings[$i]['Shop']['permalink']; ?>"><?php echo nl2br(h($listings[$i]['Shop']['name'])); ?></a></h1>
								<div class="category"><span class="price">$<?php echo $listings[$i]['Shop']['price']; ?></span><a href="/searches/browse/<?php echo $listings[$i]['Category']['short_name']; ?>"><?php echo $listings[$i]['Category']['display_name']; ?></a></div>
								<div class="userlisted">
									<span class="typicn user"></span> Listed by <a href="/users/profile/<?php echo $listings[$i]['User']['id']; ?>"><?php echo $listings[$i]['User']['display_name']; ?></a>
								</div>
							</div>
						</div>
				<?php if($i == 3 || $i%4 == 3 || $i == count($listings)-1): ?>
				</div>
				<?php endif; ?>
				<?php endfor;
		endif; ?>
	</div>
</div>