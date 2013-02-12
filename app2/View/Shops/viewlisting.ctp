<?php
	$this->start('css');
	echo $this->Html->css(array('shops/viewlisting', 'http://cdn.leafletjs.com/leaflet-0.4/leaflet.css'));
	$this->end();
	
	$this->start('facebookMeta');
		echo "<meta property=\"og:image\" content=\"".$listing['Image'][0]['url']."\" />";
	$this->end();
	
	$this->end();
	$this->start('scriptBottom');
	echo'<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "cffa0d8a-32aa-4e85-aabf-01228a58cf29"});</script>';
	echo $this->Html->script(array('shops/viewlisting', 'http://cdn.leafletjs.com/leaflet-0.4/leaflet.js'));
	/*Map Stuff */
	if(isset($school) && !empty($school)){
	?>
	
	
	<script>
		$(function(){
			var map = L.map('map').setView([<?php echo $school['School']['latitude'].",".$school['School']['longitude']; ?>], 14);
			L.tileLayer('http://{s}.tile.cloudmade.com/7ced7f56137c4570ac85691831b04c56/997/256/{z}/{x}/{y}.png', {
    attribution: ''}).addTo(map);
			var popup = L.popup().setLatLng([<?php echo $school['School']['latitude'].",".$school['School']['longitude']; ?>]).setContent('<?php echo $school['School']['name']; ?>').openOn(map);
		});
	</script>
<?php
	}
	$this->end();
	/*End Map Stuff*/
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
	<div class="row">
		<div class="eight columns">
			<?php if($auth['id'] == $listing['Shop']['user_id']) { ?>
				<a id="edit" href="/shops/edit/<?php echo $listing['Shop']['id']; ?>">Edit this Listing</a>
			<?php } ?>
			<div>
				<div class="favoriteadd"><a class="addfavorite<?php if(!isset($auth) || empty($auth)){
						echo "disabled"; }elseif(isset($auth) && !empty($favorite)){
									echo "used";
								}
						?>" data-listingid="<?php echo $listing['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="typicn heart" data-title="heart"></span></a>
				</div><h1 id="listingName"><?php echo h($listing['Shop']['name']); ?></h1>
			</div>
			<div id="listingPics">
				<div id="gallery">
					<?php 
					if(!empty($listing['Image'])){
						for($i = 0; $i < count($listing['Image']); $i++){ ?>
					<?php echo "<div style='width: 100%; height: 100%; background: #111;'>".$this->Html->image($listing['Image'][$i]['url'].'/convert?w=560&height=420&fit=clip')."</div>";
						}
					}else{
						echo $this->Html->image("loading.gif");
					}?>
				</div>
			</div>
			<div id="description">
				<?php echo nl2br(h($listing['Shop']['description'])); ?>
			</div>
			<div id="reviews" class="row">
				<div class="fb-comments" data-href="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" data-num-posts="2" data-width="700"></div>
			</div>
		</div>
		<div class="four columns">
			<div class="clearfix" id="buy">
				<div class="price">
					$<?php echo $listing['Shop']['price']; ?>
					<div class="shipping"><?php if($listing['Shop']['shipping'] == 0){ echo "FREE"; } else { echo "$".$listing['Shop']['shipping']; } ?> Shipping</div>
				</div>
				<div>
					<a class="buyNow" href="/payments/pay/<?php echo $listing['Shop']['id']; ?>">Buy Now</a>
					<a class="tradeNow" href="/shops/trade/<?php echo $listing['Shop']['id']; ?>">Cash / Trade</a>
				</div>
			</div>
			<div id="info_panel">
				<section>
					<h3 class="subheader">Like this listing?</h3>
					<div id="social">
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_reddit_large' displayText='Reddit'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_linkedin_large' displayText='LinkedIn'></span>
					</div>
				</section>
				<section class="clearfix">
					<h3 class="subheader">User Info</h3>
					<div class="user_info">
						<a href="/users/profile/<?php echo $listing['User']['id']; ?>">
						<img src="<?php echo $listing['User']['profilepic']; ?>" class="avatar" />
						<?php echo $listing['User']['display_name']; ?></a>
					</div>
					<div>
						<a href="/users/profile/<?php echo $listing['User']['id']; ?>"><span class="user typicn"></span> View <?php echo $listing['User']['display_name']; ?>'s Profile</a>
						<a data-reveal-id="sendmessage" href="/users/profile/<?php echo $listing['User']['id']; ?>"><span class="write typicn"></span> Message <?php echo $listing['User']['display_name']; ?></a>
					</div>
				</section>
				<?php if(isset($school) && !empty($school['School']['short_id'])){ ?>
				<section class="clearfix">
					<h3 class="subheader">School</h3>
					<div class="school_info">
						<a href="/schools/<?php echo $school['School']['short_id']; ?>"><b><?php echo $school['School']['name']; ?></b>
						<?php if(isset($school['School']['logo'])){ ?><img src="<?php echo $school['School']['logo']; ?>" class="avatar" /><?php } ?></a>
						 <div id="map"></div>
					</div>
				</section>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id="sendmessage" class="reveal-modal small">
	  <h2>Message <?php echo $listing['User']['display_name']; ?></h2>
	  <p class="lead">Got a question or comment?</p>
	  <p>
		<?php echo $this->Form->create("Message", array("url" => "/users/message/".$listing['User']['id'])); ?>
		<?php echo $this->Form->input("Thread.subject", array("type" => "text", "value" => "Question about ".$listing['Shop']['name'])); ?>
		<?php echo $this->Form->input("Thread.message", array("type" => "textarea", "value" => "\n\n\nhttp://theboxngo.com/shops/viewlisting/".$listing['Shop']['id'])); ?>
		<?php echo $this->Form->end("Send Message"); ?>
	  </p>
	  <a class="close-reveal-modal">&#215;</a>
	</div>
</div>