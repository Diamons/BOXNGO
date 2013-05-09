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
			asddsa
		</div>
		<div class="nine columns">
			<dl class="tabs">
				<dd class="active"><a href="#simple1">Selling</a></dd>
				<dd><a href="#fav">My Favorites</a></dd>
				<dd><a href="#simple3">Simple Tab 3</a></dd>
			</dl>
			<ul class="tabs-content">
				<li class="active" id="simple1Tab">This is simple tab 1s content. Pretty neat, huh?</li>
				<li id="simple2Tab">This is simple tab 2s content. Now you see it!</li>
				<li id="simple3Tab">This is simple tab 3s content.</li>
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