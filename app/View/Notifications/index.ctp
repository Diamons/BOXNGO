<div id="content" class="wrapper">
	<h1>Notification Stream</h1>
<?php
	for($i = count($notificationList)-1; $i >= 0; $i--){ ?>
	<div class="clearfix notification_item">
	<?php vardump($notificationList[0]); ?>
		<?php if($notificationList[$i]['Notification']['name'] == "comment_listing"){ ?>
			<?php echo $this->Html->image($notificationList[$i]['Notification']['image'], array('alt' => 'New Comment', 'class' => 'notification_icon')); ?>
			<a href="/users/profile/<?php echo $notificationList[$i]['User']['id']; ?>">
				<?php echo $notificationList[$i]['User']['display_name']; ?></a> has posted a <a href="/shops/viewlisting/<?php echo $notificationList[$i]['NotificationItem']['attachment_id']; ?>"><?php echo $notificationList[$i]['Notification']['action']; ?>
			</a>
			<div class="timeAgoInWords"><?php echo $this->Time->timeAgoInWords($notificationList[$i]['NotificationItem']['created']->sec); ?></div>
		<?php }elseif($notificationList[$i]['Notification']['name'] == "favorite_listing"){ ?>
			<?php echo $this->Html->image($notificationList[$i]['Notification']['image'], array('alt' => 'Favorite', 'class' => 'notification_icon')); ?>
			<a href="/users/profile/<?php echo $notificationList[$i]['User']['id']; ?>">
				<?php echo $notificationList[$i]['User']['display_name']; ?></a> has <a href="/shops/viewlisting/<?php echo $notificationList[$i]['NotificationItem']['attachment_id']; ?>"><?php echo $notificationList[$i]['Notification']['action']; ?>
			</a>
			<div class="timeAgoInWords"><?php echo $this->Time->timeAgoInWords($notificationList[$i]['NotificationItem']['created']->sec); ?></div>
		<?php } ?>
	</div>
<?php } ?>
</div>
