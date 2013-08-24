<?php $this->start('css');
	echo $this->Html->css(array('searches/search', 'pages/main', 'users/profile', 'http://fonts.googleapis.com/css?family=Quicksand:300,400,700', 'http://fonts.googleapis.com/css?family=Lato:400,300'));
$this->end();
$this->start('scriptBottom');
	echo $this->Html->script(array('users/profile'));
$this->end();
?>

<div id="content" class="wrapper">
	<div class="row">
		<div class="userInfo col-2 col-lg-2">
			<div>
				<div class="profile_snippet">
					<div class="bio">
						<?php echo $this->Html->image($userInfo['User']['profilepic'], array('class' => 'bg')); ?>
					</div>
				</div>
				<?php echo $userInfo['User']['display_name']; ?>
				<div class="data content">
					<div class="row">
						<div class="col-6 col-lg-6">
							<?php echo number_format($shopFavorites); ?>
							<span>Shop Favorites</span>
						</div>
						<div class="col-6 col-lg-6">
							<?php echo number_format($shopViews); ?>
							<span>Shop Views</span>
						</div>
					</div>
					<a class="sendUserMessage" data-toggle="modal" href="#sendmessage"> <i class="icon-envelope"></i> Send Message</a>
				</div>

			</div>
		</div>
		<div id="profile_feed" class="col-10 col-lg-10">
			<div class="panel panel-info">
				<div class="panel-heading">Profile Info</div>
				<div class="panel-body"><?php if(!empty($userInfo['User']['profile_info'])){ echo nl2br(h($userInfo['User']['profile_info'])); } else { ?>
				<i>This user has not filled this out yet. To fill this information out, click <a href="/dashboard/manageaccount">here</a>.</i>
				<?php } ?></div>
				
			</div>
			<ul id="userProfileSections" class="nav nav-pills">
				<li class="active"><a href="#listings" data-toggle="tab"><?php echo h($userInfo['User']['display_name']); ?>'s Listings</a></li>
				<li><a href="#favorites" data-toggle="tab"><?php echo h($userInfo['User']['display_name']); ?>'s Favorites</a></li>
			</ul>
			<div id="userProfileSectionsContent" class="tab-content">
				<div class="tab-pane fade active in" id="listings">
					<?php echo $this->element('four_columns_listings', array('listings' => $shopItems)); ?>
				</div>
				<div class="tab-pane fade listings" id="favorites">
					<?php echo $this->element('four_columns_listings', array('listings' => $favorites)); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if(isset($auth) && !empty($auth)){ ?>
<div id="sendmessage" class="modal fade">
	<?php echo $this->Form->create("Message", array("url" => "/users/message/".$userInfo['User']['id'])); ?>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Message <?php echo $userInfo['User']['display_name']; ?></h4>
				</div>
				<div class="modal-body">
				
					<?php echo $this->Form->input("Thread.subject", array("class" => "form-control", "type" => "text")); ?>
					<?php echo $this->Form->input("Thread.message", array("class" => "form-control", "type" => "textarea")); ?>
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
