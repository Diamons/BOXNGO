<div>
    <h1>You have a new message!</h1>
	<p>
		<a href="<?php echo $domain; ?>">BOX'NGO</a> is an online platform that makes it easy for people to sell online.
	</p>
	
	<p>
		You have received a message on BOX'NGO. To reply to this message, you must login to your dashboard and reply.
	</p>
	
	<p style="padding-top: 15px; border-top: 1px solid #CCC;">
		<b style="display:block;"><?php echo nl2br(h($variables['subject'])); ?></b>
		<div style="font-size: 11px; color: #999; font-style: italic;"><?php echo nl2br(h($variables['message'])); ?></div>
	</p>

</div>