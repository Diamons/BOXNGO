<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/messages'));
$this->end();
?>
<div class="clearfix dashwrapper">
	<h2 class="subject"><?php echo h($thread['Thread']['subject']); ?></h2>
	<div class="messages">
		<?php for($i = 0; $i < count($thread['Message']); $i++){ ?>
			<?php $user = $thread['User'][$thread['Message'][$i]['user_id']]['User']; ?>
			<div class="row <?php if($user['id'] == $thread['Message'][0]['user_id']){ echo "alternative"; } ?> message_individual">
				<div class="three columns">
					<a href="/user/profile/<?php echo $user['id']; ?>"><?php echo $user['display_name']; ?></a>
					<span class="date"><?php echo $this->Time->timeAgoInWords($thread['Message'][$i]['created'], array('format' => 'F jS, Y', 'end' => '+1 month')); ?></span>
				</div>
				<div class="nine columns">
					<?php echo nl2br(h($thread['Message'][$i]['message'])); ?>
				</div>
			</div>
		<?php } ?>
	</div>
	
	<?php echo $this->Form->create('Message', array('url' => '/users/message/0/'.$thread['Thread']['id'])); ?>
		<?php echo $this->Form->input("Message.message"); ?>
		<?php echo $this->Form->end("Reply"); ?>
</div>