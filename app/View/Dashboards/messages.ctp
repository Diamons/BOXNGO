<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/messages'));
$this->end();
?>
<div class="dashwrapper">
	<h2>My Messages</h2>
	<div class="row">
		<div class="six columns"><h6>Subject</h6></div>
		<div class="three columns"><h6>User</h6></div>
		<div class="three columns"><h6>Time</h6></div>
	</div>
	<?php for($i = 0; $i < count($threads); $i++){ ?>
		<a class="message_container <?php echo $threads[$i]['Thread']['unread']; ?>" href="/dashboard/readmessage/<?php echo $threads[$i]['Thread']['id']; ?>">
			<div class="row">
				<div class="six columns">
					<?php echo h($threads[$i]['Thread']['subject']); ?>
					<span class="message_excerpt"><?php echo h($threads[$i]['Message'][count($threads[$i]['Message'])-1]['message']); ?></span>
				</div>
				<div class="three columns">
					<?php echo $threads[$i]['User']['display_name']; ?>
				</div>
				<div class="three columns">
					<span class="date"><?php echo $this->Time->timeAgoInWords($threads[$i]['Thread']['modified'], array('format' => 'F jS, Y', 'end' => '+1 month')); ?></span>
				</div>
			</div>
		</a>
	<?php } ?>
</div>
