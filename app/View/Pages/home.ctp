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
		echo $this->Html->css('foundation.min');
		echo $this->Html->css('typicons');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('app');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<?php echo $this->fetch('facebookMeta'); ?>
	<meta property="og:image" content="http://theboxngo.com/boxngologofacebook.png" />
	<?php echo $this->Html->script(array('http://code.jquery.com/jquery-latest.min.js', 'http://code.jquery.com/ui/1.10.0/jquery-ui.js')); ?>
	
	<?php
		echo $this->fetch('script');
	?>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<?php //debug($collection); ?>
		<div id="content_container">
			<div id="content" class="wrapper">
				<div class="row">
					<div id="guest_links">
						<a href="/search">Browse Listings</a>
						<a href="/users">Log In</a>
						<a id="register" href="/users">Register (Free)</a>
					</div>
					<a href="/" id="logo"><img src="/logo.png" /></a>
				</div>
				<div class="row" id="main_content">
					<div class="six columns">
						<h1>Online Buying and Selling Made Easy!</h1>
						<h2>Free registration, easy listing, quick payments via check or PayPal, one flat fee*, user reviews, quick support, and much more! Buying and selling online has never been so simple.</h2>
						<a href="/users" id="buyAndSell"><i class="icon-signin"></i> Sign up for Free</a>
						<div class="asterisk">*BOX'NGO charges a flat 10% fee. There are no additional listing fees, subtitle fees, image fees, PayPal fees, or anything ele period. Our job is to make selling online easy and no seller should have to add up fees and percentages of a sale to figure out how much they earned. We take care of everything for you and give you 90% of each and every sale.</div>
					</div>
					<div id="collectionHome" class="six columns">
						<div class="row">
							<?php for($i = 0; $i < 3; $i++){ ?>
								<div class="three columns">
									<a href="<?php echo $collection['CollectionItem'][$i]['Shop']['full_url']; ?>"><?php echo $this->Html->image($collection['CollectionItem'][$i]['Shop']['Image'][0]['url'].'/convert?width=140&height=140&fit=crop'); ?></a>
								</div>
							<?php } ?>
							<div class="three columns note_block">
								<div>
									1,000+
									<span class="small">New Listings</span>
								</div>
							</div>
						</div>
						<div class="row">
							<?php for($i = 3; $i < 6; $i++){ ?>
								<div class="three columns">
									<a href="<?php echo $collection['CollectionItem'][$i]['Shop']['full_url']; ?>"><?php echo $this->Html->image($collection['CollectionItem'][$i]['Shop']['Image'][0]['url'].'/convert?width=140&height=140&fit=crop'); ?></a>
								</div>
							<?php } ?>
							<div class="three columns note_block">
								<div>
									250+ 
									<span class="small">Average Views</span>
								</div>
							</div>
						</div>
						<div class="row">
							<?php for($i = 6; $i < 9; $i++){ ?>
								<div class="three columns">
									<a href="<?php echo $collection['CollectionItem'][$i]['Shop']['full_url']; ?>"><?php echo $this->Html->image($collection['CollectionItem'][$i]['Shop']['Image'][0]['url'].'/convert?width=140&height=140&fit=crop'); ?></a>
								</div>
							<?php } ?>
							<div id="browse_note" class="three columns note_block">
								<a href="#">Browse <i class="icon-arrow-right"></i>
									<span class="small">More Listings</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="features_body" class="wrapper">
			<div class="row">
				<div class="nine columns">
					<div class="row">
						<div class="six columns">
							<div class="feature row">
								<div class="four columns">
									<i class="icon-credit-card"></i>
								</div>
								<div class="eight columns">
									<h3>One Simple 10% Fee</h3>
									Many online selling sites charge listing fees, refund fees, photo fees, transfer fees, and more. We charge one simple 10% fee that covers everything for you so that you earn 90% every time.
								</div>
							</div>
							<div class="feature row">
								<div class="four columns">
									<i class="icon-dollar"></i>
								</div>
								<div class="eight columns">
									<h3>Quick Payments</h3>
									No more waiting to get paid and disputing sales. With BOX'NGO, we pay you within 24 hours via PayPal or if you choose, every 2 weeks via Check minus postage.
								</div>
							</div>
							<div class="feature row">
								<div class="four columns">
									<i class="icon-comments"></i>
								</div>
								<div class="eight columns">
									<h3>User Reviews</h3>
									View comments, discuss listings, and listen to other users voice their opinions on their buying and selling experience.
								</div>
							</div>
						</div>
						<div class="six columns">
							<div class="feature row">
								<div class="four columns">
									<i class="icon-heart"></i>
								</div>
								<div class="eight columns">
									<h3>Fast and Easy Listing</h3>
									Fill out a few quick fields, upload an image, and get your item listed. All in under 30 seconds. There's no quicker and easier way to sell online than with BOX'NGO.
								</div>
							</div>
							<div class="feature row">
								<div class="four columns">
									<i class="icon-shield"></i>
								</div>
								<div class="eight columns">
									<h3>Excellent Support</h3>
									Our support team responds quickly and is there to help you with any issues you may have although to be honest, with a site as quick and easy ours, we rarely hear from people.
								</div>
							</div>
							<div class="feature row">
								<div class="four columns">
									<i class="icon-bullhorn"></i>
								</div>
								<div class="eight columns">
									<h3>Free Promotion</h3>
									Listing not doing so well? BOX'NGO automatically promotes quality listings that don't have a lot of views.
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="three columns">

				</div>
			</div>
		</div>
</body>

</html>