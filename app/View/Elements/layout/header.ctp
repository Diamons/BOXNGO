<div class="navbar">
	
	<div class="wrapper">
		<div style="margin-top: 0;" class="col-xs-2 col-md-2">
			<a class="navbar-brand" href="/"><img src="/logo.png" alt="BOX'NGO" /></a>
		</div>
		<div style="text-align: center;" class="col-xs-3 col-md-3">
			<a class="menu_link" href="/shops/shoplist">Sell</a>
			<a class="menu_link" href="/dashboard">Dashboard<?php if(isset($auth) && ((int)$notifications + (int)$messages) > 0){echo "<span class='notification'>".((int)$notifications + (int)$messages)."</span>";};?></a>
			<a class="menu_link" href="/forum">Community</a>
		</div>
		<div class="col-xs-4 col-md-4 input-group searchNav">
			<?php echo $this->Form->create('Search', array('action' => 'index', 'type' => 'GET', 'inputDefaults' => array('div'=>false,'label'=>false),'class' => 'custom')); ?>
			<?php echo $this->Form->input("Search.query", array("label" => false, "id" => "SearchQuery", "class" => "form-control")); ?>
			<?php echo $this->Form->end(); ?>
			<span class="input-group-btn">
				<button id="searchTriggerButton" class="btn btn-default" type="button">Search</button>
			</span>
		</div>
		<?php if(!isset($auth)){ ?>
		<div class="text-right user_actions col-xs-3 col-md-3">
			<a class="btn btn-default" href="/users">Sign In</a>
			<a class="btn btn-primary" href="/users">Register</a>
		</div>
		<?php }else{ ?>
			<div class="col-xs-3 col-md-3 text-right">
				<a id="notificationItems" href="/notifications" class="<?php if($notificationItems > 0){ ?>unread<?php } ?>">
				<?php if($notificationItems > 0){ ?>
					<i class="icon-envelope"></i>
				<?php } else { ?>
					<i class="icon-envelope-alt"></i>
				<?php } ?>
				</a>
				Welcome back <a href="/users/profile/<?php echo $auth['id']; ?>"><?php echo $auth['username']; ?></a>
				<div class="text-right"><div id="millz"><a href="/dashboard/earnpoints"><?php echo $points; ?> Millz</a></div><a href="/users/logout"><small>Logout</small></a></div>
			</div>	
			
		<?php } ?>
	</div>
</div>
