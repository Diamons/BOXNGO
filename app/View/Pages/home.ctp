<?php

$cakeDescription = __d('box\'ngo', 'BOX\'NGO');
$this->start('css');
echo $this->Html->css(array('pages/main_home'));
$this->end();
$this->start('meta'); ?>
<meta name="title" content="BOX'NGO - Online selling Made Easy" />
<meta name="keywords" content="buy, sell, trade, buying, selling, trading" />
<meta name="description" content="Buy, sell, and trade in the online marketplace that makes online commerce convenient. BOX'NGO makes buying, selling, and trading online easier than ever before." />

<?php $this->end(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?> - 
		<?php echo nl2br(h($title_for_layout)); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('typicons');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('app');
		echo $this->Html->css('shops/jquery.mCustomScrollbar');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<?php echo $this->fetch('facebookMeta'); ?>
	<meta property="og:image" content="http://theboxngo.com/boxngologofacebook.png" />
	<?php echo $this->Html->script(array('http://code.jquery.com/jquery-latest.min.js', 'http://code.jquery.com/ui/1.10.0/jquery-ui.js'));
		echo  $this->Html->script(array('shops/jquery.mCustomScrollbar.min'));
	?>
	<?php
		echo $this->fetch('script');
	?>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script>
	$(window).load(function(){
		$("#recent_activity").mCustomScrollbar({
	    	scrollButtons:{
				enable:true
			},
			theme: "dark"
	    });
	});
	</script>
</head>
<body>
	<?php //debug($collection); ?>
		<div id="content_container">
			<div style="background: transparent; border: none; padding: 10px 0;" id="content" class="wrapper">
				<div class="row">
					<div id="guest_links">
						<a href="/search">Browse Listings</a>
						<a href="/users">Log In</a>
						<a id="register" href="/users">Register (Free)</a>
					</div>
					<a href="/" id="logo"><img src="/logo.png" /></a>
				</div>
				<div class="row" id="main_content">
					<div class="col-xs-6 col-md-6">
						<h1>Online Buying and Selling Made Easy!</h1>
						<h2>Free registration, easy listing, quick payments via check or PayPal, one flat fee*, user reviews, quick support, and much more! Buying and selling online has never been so simple.</h2>
						<a href="/users" id="buyAndSell"><i class="icon-signin"></i> Sign up for Free</a>
						<div class="asterisk">*BOX'NGO charges a flat 10% fee. There are no additional listing fees, image fees, PayPal fees, or anything else period. Our job is to make selling online easy and no seller should have to add up fees and percentages of a sale to figure out how much they earned. We take care of everything for you and give you 90% profit of each and every sale.</div>
					</div>
					<div class="recent_activity_container col-xs-6 col-md-6">
						<div id="recent_activity">
							<div class="recent_container">
								<?php foreach($activity as $a){ ?>
									<div class="recent_event">
										Someone viewed <a href="<?php echo $a['Shop']['full_url']; ?>"><?php echo h($a['Shop']['name']); ?></a> about <b><?php echo $this->Time->timeAgoInWords($a['Shopview']['created']); ?></b>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="features_body" class="wrapper">
			<div class="row">
				<div class="col-xs-6 col-md-6">
					<div class="feature row">
						<div class="col-4 col-4-lg">
							<i class="icon-credit-card"></i>
						</div>
						<div class="col-8 col-8-lg">
							<h3>Earn 90% Profit</h3>
							Many online selling sites charge listing fees, refund fees, photo fees, transfer fees, and more. We charge one simple 10% fee that covers everything for you so that you earn 90% every time.
						</div>
					</div>
					<div class="feature row">
						<div class="col-4 col-4-lg">
							<i class="icon-dollar"></i>
						</div>
						<div class="col-8 col-8-lg">
							<h3>Quick Payments</h3>
							No more waiting to get paid and disputing sales. With BOX'NGO, we pay you within 24 hours via PayPal or if you choose, every 2 weeks via Check minus postage.
						</div>
					</div>
					<div class="feature row">
						<div class="col-4 col-4-lg">
							<i class="icon-comments"></i>
						</div>
						<div class="col-8 col-8-lg">
							<h3>User Reviews</h3>
							View comments, discuss listings, and listen to other users voice their opinions on their buying and selling experience.
						</div>
					</div>
				</div>
				<div class="col-6 col-6-lg">
					<div class="feature row">
						<div class="col-4 col-4-lg">
							<i class="icon-heart"></i>
						</div>
						<div class="col-8 col-8-lg">
							<h3>Fast and Easy Listing</h3>
							Fill out a few quick fields, upload an image, and get your item listed. All in under 30 seconds. There's no quicker and easier way to sell online than with BOX'NGO.
						</div>
					</div>
					<div class="feature row">
						<div class="col-4 col-4-lg">
							<i class="icon-shield"></i>
						</div>
						<div class="col-8 col-8-lg">
							<h3>Excellent Support</h3>
							Our support team responds quickly and is there to help you with any issues you may have, although to be honest, with a site as quick and easy ours, we rarely hear from people.
						</div>
					</div>
					<div class="feature row">
						<div class="col-4 col-4-lg">
							<i class="icon-bullhorn"></i>
						</div>
						<div class="col-8 col-8-lg">
							<h3>Free Promotion</h3>
							Listing not doing so well? BOX'NGO automatically promotes quality listings that don't have a lot of views.
						</div>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-2509553-6']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>
</body>

</html>
