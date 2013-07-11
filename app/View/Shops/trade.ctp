<?php $this->start('css');
echo $this->Html->css(array('dashboard/main','shops/trade'));
$this->end();
?>

<div class="row wrapper" id="content">
	<div class="six columns leftpanel">
	</div>
	<div class="six columns rightpanel">
		<h1>Send a Trade Offer via Email</h1>
		<div>
			You are trading for the item <a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $listing['Shop']['id']; ?>"><?php echo nl2br(h($listing['Shop']['name'])); ?></a> and the user is located at <b><?php echo nl2br(h($school['School']['name'])); ?></b>. By filling out the following form, your email address will be sent to the user and you will receive any responses via your email address <?php echo $auth['username']; ?>. <b>If you want to pay in cash/person, this is also considered a trade.</b>
			
			<?php echo $this->Form->create("Message", array("url" => $this->webroot."shops/trade/".$listing['Shop']['id'])); ?>
			Message <span style="font-size: 10px;">(Make sure you mention your offer)</span>
			<?php echo $this->Form->textarea("Message.message"); ?>
			Contact Information
			<?php echo $this->Form->textarea("Message.contact", array("style" => "min-height: 40px;")); ?>
			<?php echo $this->Form->end("Send Email"); ?>
		</div>
	</div>
</div>