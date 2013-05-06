<?php
	$this->start('css');
	echo $this->Html->css(array('shops/viewlisting', 'http://cdn.leafletjs.com/leaflet-0.4/leaflet.css'));
	$this->end();
	
	$this->start('facebookMeta'); ?>
		<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# theboxngo: http://ogp.me/ns/fb/theboxngo#">
		<meta property="fb:app_id" content="116996495106723" /> 
		<meta property="og:type"   content="object" /> 
		<meta property="og:url"    content="<?php echo Router::url(null, true) ?>" /> 
		<meta property="og:title"  content="$<?php echo $listing['Shop']['price']." ".$listing['Shop']['name']; ?>" /> 
		<meta property="og:description"  content="<?php echo $listing['Shop']['description']; ?>" /> 
		<meta property="og:image"  content="<?php echo $listing['Image'][0]['url']; ?>" /> 
	<?php $this->end();
	
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
			var popup = L.circle([<?php echo $school['School']['latitude'].",".$school['School']['longitude']; ?>], 220, {color: 'red', fillColor: '#f03', fillOpacity: 0.5}).addTo(map);
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
		<?php if(isset($auth) && $auth['id'] == $listing['Shop']['user_id']) { ?>
			<a id="edit" href="/shops/edit/<?php echo $listing['Shop']['id']; ?>">Edit this Listing</a>
		<?php } ?>
		<div>
			<div class="favoriteadd"><a class="addfavorite<?php if(!isset($auth) || empty($auth)){
					echo "disabled"; }elseif(isset($auth) && !empty($favorite)){
								echo "used";
							}
					?>" data-listingid="<?php echo $listing['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="typicn heart" data-title="heart"></span><i class="loading icon-spinner icon-spin"></i></a>
			</div><h1 id="listingName"><?php echo h($listing['Shop']['name']); ?></h1>
		</div>
		<div class="eight columns">
			<div id="listingPics">
				<div id="gallery">
					<?php 
					if(!empty($listing['Image'])){
						for($i = 0; $i < count($listing['Image']); $i++){ ?>
					<?php echo "<div style='width: 100%; height: 100%; background: #111;'>".$this->Html->image($listing['Image'][$i]['url'].'/convert?w=737&height=410&fit=clip')."</div>";
						}
					}else{
						echo $this->Html->image("loading.gif");
					}?>
				</div>
			</div>
			<div id="description">
				<?php echo nl2br(h($listing['Shop']['description'])); ?>
			</div>
			<div id="similarItems" class="panel row">
				<h4>Similar Items</h4>
				<?php for($i = 0; $i < count($relatedItems); $i++){ ?>
					<div class="two columns">
						<a href="/shops/viewlisting/<?php echo $relatedItems[$i]['Shop']['id']; ?>/<?php echo $relatedItems[$i]['Shop']['permalink']; ?>"><img src="<?php echo $relatedItems[$i]['Image'][0]['url']; ?>/convert?w=180&height=120&fit=crop" /><h5><?php echo $relatedItems[$i]['Shop']['name']; ?></h5></a>
					</div>
				<?php } ?>
			</div>
			<div id="reviews" class="row">
			    <div id="disqus_thread"></div>
			    <script type="text/javascript">
			        var disqus_shortname = 'boxngo'; // required: replace example with your forum shortname
			        var disqus_url = 'http://theboxngo.com/viewlisting/<?php echo $listing['Shop']['id']; ?>';
			        (function() {
			            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			        })();
			    </script>
			    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
			</div>
		</div>
		<div class="four columns">
			<div class="row" id="buy">
				<div class="three columns page_views">
					<?php echo $views; ?>
					<div>Views</div>
				</div>
				<div class="five columns price">
					$<?php echo $listing['Shop']['price']; ?>
					<div class="shipping"><?php if($listing['Shop']['shipping'] == 0){ echo "FREE"; } else { echo "$".$listing['Shop']['shipping']; } ?> Shipping</div>
				</div>
				<div class="four columns">
					<a class="buyNow" href="/payments/pay/<?php echo $listing['Shop']['id']; ?>">Buy Now</a>
					<?php if(!$sameSchool){ ?> <a style="display:none;" class="tradeNow" href="/shops/trade/<?php echo $listing['Shop']['id']; ?>">Trade</a> <?php } ?>
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
	<div id="sendmessage" class="reveal-modal medium">
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