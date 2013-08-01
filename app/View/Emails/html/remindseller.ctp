<div>
    <h1>Reminder! You have an order awaiting approval!</h1>
	<p>
		<a href="<?php echo $domain; ?>">BOX'NGO</a> is an online platform that makes it easy for people to sell online.
	</p>
	
	<p>
		You recently received an order for the following item: <?php echo $domain."shops/viewlisting/".$variables['listing']['Shop']['id']; ?>. If you do not respond to the order within 4 days of receiving it, the order will automatically be cancelled on your behalf.
	</p>
	<p>
		To manage and respond to your orders, <a href="<?php echo $domain; ?>dashboard/myorders">click here</a>.
	</p>
	<p>
		<h1>Please Note</h1>

		Repeated cancellations and non responses result in a poor experience for everyone involved. Try and avoid cancellations by responding to order requests and only listing things that you can and want to sell.
	</p>
</div>