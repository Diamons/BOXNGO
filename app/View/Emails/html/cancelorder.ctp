<div>
    <h1>Order Cancelled, Refund Issued</h1>
	<p>
		<a href="<?php echo $domain; ?>">BOX'NGO</a> is an online platform that makes it easy for people to sell online.
	</p>
	
	<p>
		You recently placed an order for the following item: <a href="<?php echo $variables['link']; ?>"><?php echo $variables['name']; ?></a>. We regret to inform you that the seller has cancelled your order. Your refund will be issued in the next 24-48 hours. Please contact support for any issues you may have.
	</p>
	<p>
		<h3>Order Details</h3>
		<table>
			<tr>
				<td colspan="1" rowspan="3">
					<h4 style="padding-right: 20px; margin: 0;"><?php echo $variables['name']; ?></h4>
					<a href="<?php echo $variables['link']; ?>"><?php echo $this->Html->image($variables['imageUrl']."/convert?h=128&w=128&fit=crop"); ?></a>
				</td>
				<td>Sale Price:</td><td style="padding-left: 20px;">$<?php echo number_format($variables['totalPrice'], 2); ?></td>
			</tr>

		</table>
	</p>
	<p>
		<h4>Personal Reference</h4>

		The following is for your reference only, should you need it so that the support team may help assist you quicker.
		<br /><br />
		<b>Order ID Number: </b> <?php echo $variables['Order']['id']; ?><br />
		<b>Transaction ID Number: </b> <?php echo $variables['Payment']['id']; ?><br />
		<b>Card Number: </b>**** - **** - **** - <?php echo $variables['stripe']->card['last4']; ?>
	</p>
</div>