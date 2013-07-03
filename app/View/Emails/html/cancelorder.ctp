<div>
    <h1>Order Cancelled, Refund Issued</h1>
	<p>
		<a href="<?php echo $domain; ?>">BOX'NGO</a> is an online platform that makes it easy for people to sell online.
	</p>
	
	<p>
		You recently placed an order for the following item: <?php echo $domain."shops/viewlisting/".$variables['listing']['Shop']['id']; ?>. We regret to inform you that the seller did not accept the order within 96 hours of receiving the notification. Therefore, we have cancelled the order and will begin the process of refunding your money. Your refund will be issued in the next 24-48 hours. Please contact support for any issues you may have.
	</p>
	<p>
		<h1>Personal Reference</h1>

		The following is for your reference only, should you need it so that the support team may help assist you quicker.
		<br /><br />
		<b>Order ID Number: </b> <?php echo $variables['order']['Order']['id']; ?><br />
		<b>Transaction ID Number: </b> <?php echo $variables['payment']['Payment']['id']; ?>
	</p>
</div>