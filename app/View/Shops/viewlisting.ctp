<?php
	$this->start('css');
	echo $this->Html->css(array('shops/viewlisting', 'shops/jquery.mCustomScrollbar', 'lightbox/magnific-popup'));
	$this->end();
	
	$this->start('facebookMeta'); ?>
		<?php echo $this->Html->meta('canonical', $listing['Shop']['full_url'], array('rel'=>'canonical', 'type'=>null, 'title'=>null, 'inline' => false));?>
		<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# theboxngo: http://ogp.me/ns/fb/theboxngo#">
		<meta property="fb:app_id" content="116996495106723" /> 
		<meta property="og:type"   content="object" /> 
		<meta property="og:url"    content="<?php echo Router::url(null, true) ?>" /> 
		<meta property="og:title"  content="$<?php echo $listing['Shop']['price']." ".$listing['Shop']['name']; ?>" /> 
		<meta itemprop="image" property="og:image"  content="<?php echo $listing['Image'][0]['url']; ?>/convert?w=200&height=200&fit=crop" /> 
	<?php $this->end();
	$this->start('pinterest');
	echo $this->Html->image($listing['Image'][0]['url'], array('id' => 'pinterestImage'));
	$this->end();
	$this->start('scriptBottom');
	echo $this->Html->script(array('shops/jquery.mCustomScrollbar.min', 'lightbox', 'shops/viewlisting'));
	$this->end();
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=116996495106723";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="wrapper" id="content">
	<?php if(isset($auth) && $auth['id'] == $listing['Shop']['user_id']) { ?>
		<div>
			<a class="btn btn-info btn-small" href="/shops/edit/<?php echo $listing['Shop']['id']; ?>">Edit this Listing</a>
		</div>
	<?php } ?>
	<div class="row">	
		<div class="row clearfix">
			<div class="favoriteadd"><a href="#" class="addfavorite<?php if(!isset($auth) || empty($auth)){
					echo "disabled"; }elseif(isset($auth) && !empty($favorite)){
								echo "used";
							}
					?>" data-listingid="<?php echo $listing['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="icon-heart" data-title="heart"></span><i class="loading icon-spinner icon-spin"></i></a>
			(<?php echo count($listing['Favorite']); ?>)
			</div><h1 id="listingName"><?php echo h($listing['Shop']['name']); ?></h1>
		</div>
		<div itemscope itemtype="http://schema.org/Product" class="col-12 col-lg-8">
			<meta itemprop="name" content="<?php echo h($listing['Shop']['name']); ?>" />
			<meta itemprop="image" content="<?php echo $listing['Image'][0]['url']; ?>/convert?w=200&height=200&fit=crop" />
			<div class="row" id="listingPics">
				<div class="col-2 col-lg-2" id="gallery">
					<?php 
					if(!empty($listing['Image'])){
						for($i = 0; $i < count($listing['Image']); $i++){ ?>
						<?php 
							echo "<div data-order='".$i."' data-image='".$listing['Image'][$i]['url']."/convert?h=420' class='imageContainer'>".$this->Html->image($listing['Image'][$i]['url'].'/convert?h=420', array('alt' => $listing['Shop']['name']))."</div>";
						}
					}else{
						echo $this->Html->image("loading.gif");
					}?>
				</div>
				<div class="col-10 col-lg-10" id="displayPicture">
					<?php for($i = 0; $i < count($listing['Image']); $i++){ ?>
						<a id="lightboxImage<?php echo $i; ?>" href="<?php echo $listing['Image'][$i]['url']; ?>"><img src="<?php echo $listing['Image'][$i]['url'].'/convert?h=420'; ?>" /></a>
					<?php } ?>
				</div>
			</div>
			<?php if($listing['User']['seller_country']){ ?>
			<div>
				<h3 class="subheader"><i class="icon-truck"></i> Shipping Info</h3>
				Shipping from <?php echo $listing['User']['seller_city']; ?>, <?php if($listing['User']['seller_country'] == "us"){ ?><?php echo $this->Country->stateName($listing['User']['seller_state']); ?>, <?php } ?><?php echo $this->Country->countryName($listing['User']['seller_country']); ?>.
			</div>
			<?php } ?>
			<div itemprop="description" id="description">
				<h3 class="subheader">Description</h3>
				<?php echo nl2br(h($listing['Shop']['description'])); ?>
			</div>
			<div id="comments" class="row">
				<?php if(isset($auth)){ ?>
					<div style="margin-bottom: 10px;"  class="clearfix">
						<a id="addComment" class="btn btn-default pull-right" href="#"><span class="plus typicn"></span> Write a Comment</a>
					</div>
				<?php } ?>
				<?php echo $this->Form->create("Comment", array("url" => "/shops/comment/".$listing['Shop']['id'])); ?>
				<?php echo $this->Form->input("Comment.message", array("class" => "form-control", "type" => "textarea")); ?>
				<div class="row">
					<?php echo $this->Form->end("Leave Comment"); ?>
				</div>
			    <?php if(!empty($comments)){ 
			    	for($i = 0; $i < count($comments); $i++){?>
				    <div class="<?php if($listing['Shop']['user_id'] == $comments[$i]['Comment']['user_id']){ ?>seller <?php } ?>row comment">
				    	<div class="userInfo col-2 col-lg-2">
				    		<a class="thumbnail" href="/users/profile/<?php echo $comments[$i]['User']['id']; ?>">
								<?php echo $this->Html->image($comments[$i]['User']['profilepic'], array('class' => 'profilePic')); ?>
							</a>
				    		<?php echo $this->Html->link($comments[$i]['User']['display_name'], "/users/profile/".$comments[$i]['User']['id']); ?>
				    		<?php if($listing['Shop']['user_id'] == $comments[$i]['Comment']['user_id']){ ?><div class="radius success label">Seller</div><?php } ?>
				    	</div>
				    	<div class="col-10 col-lg-10">
				    		<div class="date">
				    			<?php echo $this->Time->timeAgoInWords($comments[$i]['Comment']['created'], array('format' => 'F jS, Y', 'end' => '+1 year')); ?>
				    		</div>
				    		<?php echo nl2br(h($comments[$i]['Comment']['message'])); ?>
				    	</div>
				    </div>
			    <?php }
				}else{ ?>
				No comments to display.
				<?php } ?>
			</div>
		</div>
		<div class="col-12 col-lg-4">
			<a class="btn btn-success" id="buyNow" href="https://www.theboxngo.com/payments/pay/<?php echo $listing['Shop']['id']; ?>">Buy Now</a>
			<div class="row" id="buy">
				<div class="col-6 col-lg-6 page_views">
					<?php echo $views; ?>
					<div>Views</div>
				</div>
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="col-6 col-lg-6 price">
					<link itemprop="availability" href="http://schema.org/InStock" content="In Stock" />
					<meta itemprop="priceCurrency" content="USD" />
					<span>$<span itemprop="price"><?php echo $listing['Shop']['price']; ?></span></span>
					<div class="shipping"><?php if($listing['Shop']['shipping'] == 0){ echo "FREE"; } else { echo "$".$listing['Shop']['shipping']; } ?> Shipping</div>
				</div>
			</div>
			<div id="info_panel">
				<section>
					<h3 class="subheader">Like this listing?</h3>
					<div id="social">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
						<a class="addthis_button_facebook"></a>
						<a class="addthis_button_twitter"></a>
						<a class="addthis_button_pinterest_share"></a>
						<a class="addthis_button_reddit"></a>
						<a class="addthis_button_google_plusone_share"></a>
						</div>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
						<!-- AddThis Button END -->
					</div>
				</section>
				<section class="clearfix">
					<h3 class="subheader">User Info</h3>
					<div class="user_info">
						<a class="thumbnail" href="/users/profile/<?php echo $listing['User']['id']; ?>">
						<img src="<?php echo $listing['User']['profilepic']; ?>" class="profilePic" />
						</a>
						<a href="/users/profile/<?php echo $listing['User']['id']; ?>"><?php echo $listing['User']['display_name']; ?></a>
					</div>
					<div>
						<a href="/users/profile/<?php echo $listing['User']['id']; ?>"><span class="icon-user"></span> View <?php echo $listing['User']['display_name']; ?>'s Profile</a>
						<?php if(isset($auth)){ ?>
							<a data-toggle="modal" href="#sendmessage"><span class="icon-envelope-alt"></span> Message <?php echo $listing['User']['display_name']; ?></a>
						<?php } ?>
					</div>
				</section>
				<section id="similarItems" class="row clearfix">
				<h3 class="subheader">Other Listings of Interest</h3>
				<?php for($i = 0; $i < count($relatedItems); $i++){ ?>
					<div class="col-6 col-lg-6">
						<a class="thumbnail" href="<?php echo $relatedItems[$i]['Shop']['full_url']; ?>"><img src="<?php echo $relatedItems[$i]['Image'][0]['url']; ?>/convert?w=180&height=120&fit=crop" /></a><h5>
						<a href="<?php echo $relatedItems[$i]['Shop']['full_url']; ?>"><?php echo $relatedItems[$i]['Shop']['name']; ?></a></h5>
					</div>
				<?php } ?>
			</div>
				</section>
			</div>
		</div>
	</div>
<?php if(isset($auth)){ ?>
	<div id="sendmessage" class="modal fade">
	<?php echo $this->Form->create("Message", array("url" => "/users/message/".$listing['User']['id'])); ?>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Message <?php echo $listing['User']['display_name']; ?></h4>
				</div>
				<div class="modal-body">
				
					<?php echo $this->Form->input("Thread.subject", array("class" => "form-control", "type" => "text", "value" => "Question about ".$listing['Shop']['name'])); ?>
					<?php echo $this->Form->input("Thread.message", array("class" => "form-control", "type" => "textarea", "value" => "\n\n\n".$listing['Shop']['full_url'])); ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-large btn-default" data-dismiss="modal">Close</button>
					<?php echo $this->Form->submit("Send Message", array("div" => false)); ?>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
</div>
