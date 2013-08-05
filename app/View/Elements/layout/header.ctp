<div class="navbar">
  <div class="wrapper">
    <a class="navbar-brand" href="/"><img src="/logo.png" alt="BOX'NGO" /></a>
	<ul class="nav navbar-nav">
		<li><a href="/shops/shoplist">Sell</a></li>
		<li><a href="/dashboard">Dashboard<?php if(((int)$notifications + (int)$messages) > 0){echo "<span class='notification'>".((int)$notifications + (int)$messages)."</span>";};?></a></li>
	</ul>	
		<?php if(!$auth){ ?>
		<div class="user_actions nav navbar-nav pull-right">
			<a class="btn btn-default navbar-btn" href="/users">Sign In</a>
			<a class="btn btn-primary navbar-btn" href="/users">Register</a>
		</div>
		<?php }else{ ?>
		<div class="nav user_logged navbar-text pull-right">
			Welcome back <a href="/users/profile"><?php echo $auth['username']; ?></a>
			<div class="text-right"><a href="/users/logout"><small>Logout</small></a></div>
		</div>	
		<a id="notificationItems" href="/notifications" class="<?php if($notificationItems > 0){ ?>unread <?php } ?>nav user_logged pull-right">
			<?php if($notificationItems > 0){ ?>
				<i class="icon-envelope"></i>
			<?php } else { ?>
				<i class="icon-envelope-alt"></i>
			<?php } ?>
		</a>
		<?php } ?>
		<div style="width: 40%;"class="nav navbar-text pull-right input-group">
			<?php echo $this->Form->input("Search.query", array("id" => "SearchQuery", "class" => "form-control")); ?>
			<?php echo $this->Form->end(); ?>
			<span class="input-group-btn">
				<button id="searchTriggerButton" class="btn btn-default" type="button">Go!</button>
			</span>
		</div>
	
  </div>
</div>
