<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/messages'));
$this->end();
?>
<div class="dashwrapper">
	<h2>My Messages</h2>
	<div class="row">
		<div class="col-6 col-lg-6"><h6>Subject</h6></div>
		<div class="col-3 col-lg-3"><h6>User</h6></div>
		<div class="col-3 col-lg-3"><h6>Time</h6></div>
	</div>
	<?php for($i = 0; $i < count($threads); $i++){ ?>
		<a class="message_container <?php echo $threads[$i]['Thread']['unread']; ?>" href="/dashboard/readmessage/<?php echo $threads[$i]['Thread']['id']; ?>">
			<div class="row">
				<div class="col-6 col-lg-6">
					<?php echo h($threads[$i]['Thread']['subject']); ?>
					<span class="message_excerpt"><?php echo h($threads[$i]['Message'][count($threads[$i]['Message'])-1]['message']); ?></span>
				</div>
				<div class="col-3 col-lg-3">
					<?php echo $threads[$i]['User']['display_name']; ?>
				</div>
				<div class="col-3 col-lg-3">
					<span class="date"><?php echo $this->Time->timeAgoInWords($threads[$i]['Thread']['modified'], array('format' => 'F jS, Y', 'end' => '+1 month')); ?></span>
				</div>
			</div>
		</a>
	<?php } ?>
</div>
