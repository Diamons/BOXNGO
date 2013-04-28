<?php $this->start('css');
echo $this->Html->css(array('searches/search', 'users/profile'));
$this->end();
$this->start('scriptBottom');
echo $this->Html->script(array('users/profile'));
$this->end();
?>

	
<div id="content" class="wrapper">
	<div class="row">
		<div class="userInfo three columns">
			<h3 class="username"><?php echo $userInfo['User']['display_name']; ?>'s Profile</h3>
			<img src="<?php echo $userInfo['User']['profilepic']; ?>" class="avatar" />
			<?php if($auth){ ?>
				<a id="sendUserMessage" href="#" data-reveal-id="sendmessage"><i class="icon-envelope"></i> Send Message</a>
				<?php } ?>
			<section class="stats_info">
				<?php if(!empty($school['School']['name'])){ ?><span>Attending <?php echo nl2br(h($school['School']['name'])); ?></span><?php } ?>
				<div><a id="itemslistedView" href="javascript: void(0);"><div class="value"><?php echo count($userInfo['Shop']); ?></div>Items Listed</a></div>
				<div><a id="favoritesView" href="javascript: void(0);"><div class="value"><?php echo count($favorites); ?></div>Favorites</a></div>
			</section>
		</div>
		<div class="nine columns">
			<div id="favorites" class="row">
				<h1 class="section">Favorite Listings</h1>
				<?php for($i = 0; $i < count($favorites); $i++): ?>
				<?php if($i == 0 || $i % 3 == 0): ?>
				<div class="row">
				<?php endif; ?>
				<div class="four columns listing">
					<div class="listing_container">
						<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $favorites[$i]['Shop']['id'];?>/<?php echo $favorites[$i]['Shop']['permalink']; ?>">
						<?php if(!empty($favorites[$i]['Image'][0]['url'])){?>
						<img src="<?php echo $favorites[$i]['Image'][0]['url']; ?>/convert?w=265&h=271&fit=crop" class="image" />
						<?php } else { ?>
						<div class="image"></div>
						<?php } ?>
						</a>
						<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $favorites[$i]['Shop']['id'];?>"><?php echo nl2br(h($favorites[$i]['Shop']['name'])); ?></a></h1>
						
						<div class="listing_box">$<?php echo $favorites[$i]['Shop']['price']; ?></div>
						<div class="listing_box"><a class="addfavorite<?php if(!isset($auth) || empty($auth)){
						echo "disabled"; }elseif(isset($auth) && !empty($favorites[$i]['Favorite'])){
								$unique=true;
								for($k = 0; $k < count($favorites[$i]['Favorite']); $k++){
									if($favorites[$i]['Favorite'][$k]['user_id'] == $auth['id'])
										$unique = false;
								}
								if($unique == false){
									echo "used";
								}
							}
						?>" data-listingid="<?php echo $favorites[$i]['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="typicn heart" data-title="heart"></span></a></div>
						
					</div>
				</div>
				<?php if($i == 2 || $i%3 == 2 || $i == count($favorites)-1): ?>
				</div>
				<?php endif; ?>
				<?php endfor; ?>
			</div>
			<div id="shopItems" class="row">
				<h1 class="section">Items Listed</h1>
				<?php for($i = 0; $i < count($shopItems); $i++): ?>
				<?php if($i == 0 || $i % 3 == 0): ?>
				<div class="row">
				<?php endif; ?>
				<div class="four columns listing">
					<div class="listing_container">
						<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $shopItems[$i]['Shop']['id'];?>/<?php echo $shopItems[$i]['Shop']['permalink'];?>">
						<?php if(!empty($shopItems[$i]['Image'][0]['url'])){?>
						<img src="<?php echo $shopItems[$i]['Image'][0]['url']; ?>/convert?w=265&h=271&fit=crop" class="image" />
						<?php } else { ?>
						<div class="image"></div>
						<?php } ?>
						</a>
						<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $shopItems[$i]['Shop']['id'];?>/<?php echo $shopItems[$i]['Shop']['permalink'];?>"><?php echo nl2br(h($shopItems[$i]['Shop']['name'])); ?></a></h1>
						
						<div class="listing_box">$<?php echo $shopItems[$i]['Shop']['price']; ?></div>
						<div class="listing_box"><a class="addfavorite<?php if(!isset($auth) || empty($auth)){
						echo "disabled"; }elseif(isset($auth) && !empty($shopItems[$i]['Favorite'])){
								$unique=true;
								for($k = 0; $k < count($shopItems[$i]['Favorite']); $k++){
									if($shopItems[$i]['Favorite'][$k]['user_id'] == $auth['id'])
										$unique = false;
								}
								if($unique == false){
									echo "used";
								}
							}
						?>" data-listingid="<?php echo $shopItems[$i]['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="typicn heart" data-title="heart"></span></a></div>
						
					</div>
				</div>
				<?php if($i == 2 || $i%3 == 2 || $i == count($shopItems)-1): ?>
				</div>
				<?php endif; ?>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>
<?php if($auth){ ?>
<div id="sendmessage" class="reveal-modal small">
  <h2>Message <?php echo $userInfo['User']['display_name']; ?></h2>
  <p>
	<?php echo $this->Form->create("Message", array("url" => "/users/message/".$userInfo['User']['id'])); ?>
	<?php echo $this->Form->input("Thread.subject", array("type" => "text")); ?>
	<?php echo $this->Form->input("Thread.message", array("type" => "textarea")); ?>
	<?php echo $this->Form->end("Send Message"); ?>
  </p>
  <a class="close-reveal-modal">&#215;</a>
</div>
<?php } ?>