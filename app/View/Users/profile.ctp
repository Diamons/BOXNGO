<?php $this->start('css');
	echo $this->Html->css(array('searches/search', 'pages/main', 'users/profile', 'bootstrap.min'));
$this->end();
$this->start('scriptBottom');
	echo $this->Html->script(array('users/profile'));
$this->end();
?>

	
<div id="content" class="wrapper">
	<div class="row">
		<div class="userInfo two columns">
			<?php echo $this->Html->image($userInfo['User']['profilepic'], array('class' => 'profilePic')); ?>
			<?php echo $userInfo['User']['display_name']; ?>
			<?php if($userInfo['User']['role'] == "admin"){ ?>
			<div class="alert alert-success feedback_section clearfix">
				<?php echo $this->Html->image('/images/icons/great.png', array('id' => 'feedback', 'class' => 'great')); ?>
				100% Feedback
			</div>
			<?php } ?>
			<a id="sendUserMessage" href="#" data-reveal-id="sendmessage"><i class="icon-envelope"></i> Send Message</a>
		</div>
		<div id="profile_feed" class="ten columns">
			<div class="alert">
				<?php echo nl2br(h($userInfo['User']['profile_info'])); ?>
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