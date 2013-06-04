<?php $this->start('css');
	echo $this->Html->css(array('searches/search', 'pages/main', 'users/profile', 'bootstrap.min', 'http://fonts.googleapis.com/css?family=Quicksand:300,400,700', 'http://fonts.googleapis.com/css?family=Lato:400,300'));
$this->end();
$this->start('scriptBottom');
	echo $this->Html->script(array('users/profile'));
$this->end();
?>

<div id="content" class="wrapper">
	<?php echo $this->element('totop'); ?>
	<div class="row">
		<div class="userInfo two columns">
			
	<div class="container">
		<div class="profile_snippet">
			<div class="bio">
        		<?php echo $this->Html->image($userInfo['User']['profilepic'], array('class' => 'bg')); ?>
			</div>
		</div>
		<?php echo $userInfo['User']['display_name']; ?>
		<div class="data content">
			<div class="row">
				<div class="six columns">
					<?php echo number_format($shopFavorites); ?>
					<span>Shop Favorites</span>
				</div>
				<div class="six columns">
					<?php echo number_format($shopViews); ?>
					<span>Shop Views</span>
				</div>
			</div>

			<a href="#" class="sendUserMessage" data-reveal-id="sendmessage"> <i class="icon-envelope"></i> Send Message</a>
		</div>

	</div>
		</div>
		<div id="profile_feed" class="ten columns">
			<div class="alert">
				<?php if(!empty($userInfo['User']['profile_info'])){ echo nl2br(h($userInfo['User']['profile_info'])); } else { ?>
				<i>This user has not filled this out yet.</i>
				<?php } ?>
			</div>
			<dl class="tabs contained">
				<dd class="active"><a href="#forsale">For Sale</a></dd>
				<dd class="hide-for-small"><a href="#favorites">My Favorites</a></dd>
			</dl>
			<ul class="tabs-content contained">
				<li class="listings active" id="forsaleTab"><?php echo $this->element('four_columns_listings', array('listings' => $shopItems)); ?></li>
				<li class="listings" id="favoritesTab"><?php echo $this->element('four_columns_listings', array('listings' => $favorites)); ?></li>
			</ul>
		</div>
	</div>
</div>
<?php if(isset($auth) && !empty($auth)){ ?>
<div id="sendmessage" class="reveal-modal medium">
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