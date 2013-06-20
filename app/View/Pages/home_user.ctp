<?php $this->start('scriptBottom');
echo  $this->Html->script(array('shops/jquery.mCustomScrollbar.min', 'pages/home_user'));
$this->end();
$this->start('css');
echo $this->Html->css(array('shops/jquery.mCustomScrollbar', 'searches/search', 'pages/main', 'bootstrap.min'));
$this->end();
?>

<div id="content" class="wrapper">
	<div class="row">
		<?php /*<div id="update" class="alert">
			<a href="http://theboxngo.com/blog/?p=2461"><strong>Blog Update -</strong> Current State of Affairs and Upcoming Updates</a> 
		</div>*/ ?>
		<div id="categories" class="three columns">
			<?php echo $this->element('categories'); ?>
		<nav class="newlyListed">
			<div class="header">Newly Listed</div>

			<?php for($i = 0; $i < count($recent); $i++){ ?>
			<div class="row">
				<div class="three columns">
					<a href="<?php echo $recent[$i]['Shop']['full_url']; ?>">
						<?php echo $this->Html->image($recent[$i]['Image'][0]['url'].'/convert?w=64&height=64&fit=crop', array('class' => 'newListingImage', 'alt' => $recent[$i]['Shop']['name'])); ?>
					</a>	
				</div>
				<div class="newlyListedInfo nine columns">
					<a class="newlyListedName" href="<?php echo $recent[$i]['Shop']['full_url']; ?>"> <?php echo $recent[$i]['Shop']['name']; ?></a>
					<div class="category"><a href="/searches/browse/<?php echo $recent[$i]['Category']['short_name']; ?>"><?php echo $recent[$i]['Category']['display_name']; ?></a></div>
					<div class="price">$<?php echo number_format($recent[$i]['Shop']['price'], 2); ?></div>
				</div>
			</div>
			<?php } ?>

		</nav>
		</div>
		<div class="nine columns">
			<?php //<a id="promo_container" href="#"><img id="promo" alt="Father's Day Sale" src="/images/banner.jpg" /></a> ?>
			<div id="featured_recent" class="row">
				<div class="eight columns">
					<div class="row">
						<div class="featured_seller five columns">
							<a href="http://theboxngo.com/users/profile/38"><img class="featured_seller_image" src="https://www.filepicker.io/api/file/8X3zkMNUQLOxArpFO2n3/convert?width=75&height=75&fit=crop" /></a>
							<h1 class="user_title"><a href="http://theboxngo.com/users/profile/38">The Awesome Shop</a></h1>
							<h2 class="role">Featured Seller</h2>
						</div>
						<div class="featured_seller_info seven columns">
							"The Awesome Shop" was one of the first sellers on our site - back when BOX'NGO was for students only. Since then, this seller has listed many handmade pieces of work, exclusives like sold out Aldo shoes, textbooks, and much more. Whatever you're looking for, The Awesome Shop has something to admire or pique your interest regardless.
						</div>
					</div>
					<a href="http://theboxngo.com/users/profile/38" class="bar">
						View our Featured Seller <i class="icon-share-alt"></i>
					</a>
				</div>
				<div id="recent_activity" class="four columns">
					<div class="recent_container">
						<?php foreach($activity as $a){ ?>
							<div class="recent_event">
								Someone viewed <a href="<?php echo $a['Shop']['full_url']; ?>"><?php echo h($a['Shop']['name']); ?></a> about <b><?php echo $this->Time->timeAgoInWords($a['Shopview']['created']); ?></b>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div id="listings">
				<?php echo $this->element('four_columns_listings', array('listings' => $listings)); ?>
			</div>
		</div>
	</div>
</div>