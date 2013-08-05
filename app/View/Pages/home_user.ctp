<?php $this->start('scriptBottom');
echo  $this->Html->script(array('shops/jquery.mCustomScrollbar.min', 'pages/home_user'));
$this->end();
$this->start('css');
echo $this->Html->css(array('shops/jquery.mCustomScrollbar', 'searches/search', 'pages/main'));
$this->end();
?>

<div id="content" class="wrapper">
	<div class="row">
		<?php /*<div id="update" class="alert">
			<a href="http://theboxngo.com/blog/?p=2461"><strong>Blog Update -</strong> Current State of Affairs and Upcoming Updates</a> 
		</div>*/ ?>
		<div id="categories" class="col-3 col-lg-3">
			<?php echo $this->element('categories'); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">Newly Listed</div>
				<?php for($i = 0; $i < count($recent); $i++){ ?>
				<div class="row">
					<div class="col-4 col-lg-4">
						<a class="thumbnail newListingContainer" href="<?php echo $recent[$i]['Shop']['full_url']; ?>">
							<?php echo $this->Html->image($recent[$i]['Image'][0]['url'].'/convert?w=256&height=256&fit=crop', array('class' => 'img-responsive newListingImage', 'alt' => $recent[$i]['Shop']['name'])); ?>
						</a>	
					</div>
					<div class="newlyListedInfo col-8 col-lg-8">
						<a class="newlyListedName" href="<?php echo $recent[$i]['Shop']['full_url']; ?>"> <?php echo $recent[$i]['Shop']['name']; ?></a>
						<div class="category"><a href="/searches/browse/<?php echo $recent[$i]['Category']['short_name']; ?>"><?php echo $recent[$i]['Category']['display_name']; ?></a></div>
						<div class="price">$<?php echo number_format($recent[$i]['Shop']['price'], 2); ?></div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="col-9 col-lg-9">
			<?php //<a id="promo_container" href="/promotions/july4th"><img id="promo" alt="July 4th" src="/images/promo.png" /></a> ?>
			<?php
			 /*<div id="featured_recent" class="row">
				<div class="col-8 col-lg-8">
					<div class="row">
						<div class="featured_seller col-5 col-lg-5">
							<a href="http://theboxngo.com/users/profile/38"><img class="featured_seller_image" src="https://www.filepicker.io/api/file/8X3zkMNUQLOxArpFO2n3/convert?width=75&height=75&fit=crop" /></a>
							<h1 class="user_title"><a href="http://theboxngo.com/users/profile/38">The Awesome Shop</a></h1>
							<h2 class="role">Featured Seller</h2>
						</div>
						<div class="featured_seller_info col-7 col-lg-7">
							"The Awesome Shop" was one of the first sellers on our site - back when BOX'NGO was for students only. Since then, this seller has listed many handmade pieces of work, exclusives like sold out Aldo shoes, textbooks, and much more. Whatever you're looking for, The Awesome Shop has something to admire or pique your interest regardless.
						</div>
					</div>
					<a href="http://theboxngo.com/users/profile/38" class="bar">
						View our Featured Seller <i class="icon-share-alt"></i>
					</a>
				</div>
				<div id="recent_activity" class="col-4 col-lg-4">
					<div class="recent_container">
						<?php foreach($activity as $a){ ?>
							<div class="recent_event">
								Someone viewed <a href="<?php echo $a['Shop']['full_url']; ?>"><?php echo h($a['Shop']['name']); ?></a> about <b><?php echo $this->Time->timeAgoInWords($a['Shopview']['created']); ?></b>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			*/ ?>
			<div id="listings">
				<?php echo $this->element('four_columns_listings', array('listings' => $listings)); ?>
			</div>
		</div>
	</div>
</div>
