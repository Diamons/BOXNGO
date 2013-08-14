<div>
    <h1>Reminder! You have an order awaiting approval!</h1>
	<p>
		<a href="<?php echo $domain; ?>">BOX'NGO</a> is an online platform that makes it easy for people to sell online.
	</p>
	
	<p>
		You recently received an order for an item on BOX'NGO for your listing <a href="<?php echo $variables['link']; ?>"><?php echo $variables['name']; ?></a>.
	</p>
	
	<p>You need to either accept or cancel the order within 4 days in order to maintain positive feedback. If you choose not to manage the order, the order will be automatically cancelled within 4 days and you will receive automatic negative feedback. When the order is cancelled, the buyer will receive a full refund.
	</p>
	
	<p>
		<h3>Order Details</h3>
		<table>
			<tr>
				<td rowspan="3">
					<h4 style="padding-right: 20px; margin: 0;"><?php echo $variables['name']; ?></h4>
					<a href="<?php echo $variables['link']; ?>"><?php echo $this->Html->image($variables['imageUrl']."/convert?h=128&w=128&fit=crop"); ?></a>
				</td>
				<td>Sale Price:</td><td style="padding-left: 20px;">$<?php echo number_format($variables['totalPrice'], 2); ?></td>
			</tr>
			<tr>
				<td>BOX'NGO Fee</td><td style="padding-left: 20px;">$<?php echo number_format($variables['totalPrice'] * .1, 2); ?>
			</tr>
			<tr>
				<td>Seller's Profit</td><td style="padding-left: 20px;"><b>$<?php echo number_format($variables['totalPrice'] * .9, 2); ?></b></td>
			</tr>
		</table>
	</p>
	<p>
		The order will automatically expire <b><?php echo $variables['expire']; ?> EST (GMT -5).</b>
	</p>
	<p>
		To manage and respond to your orders, <a href="<?php echo $domain; ?>dashboard/myorders">click here</a>.
	</p>
	<p>
		<h1>Please Note</h1>

		Repeated cancellations and non responses result in a poor experience for everyone involved. Try and avoid cancellations by responding to order requests and only listing things that you can and want to sell.
	</p>
</div>