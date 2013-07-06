<style>
	.paypalOrder{
		border: 1px solid #ECDAED;
		border-width: 1px 0 1px 0;
		padding: 40px 10px;
		margin-bottom: 10px;
		background: #EEE;
	}

	a.submit{
		display: inline-block;
		background: #006cff;
		color: #FFF;
		padding: 15px;wwwwwwwww

	}
</style>
<?php
	for($i = 0; $i < count($paypalOrders); $i++){ ?>
	<div class="paypalOrder">
		<ol>
			<li>Track code <?php echo $paypalOrders[$i]['Order']['tracking_code']; ?> on <?php echo  $paypalOrders[$i]['Order']['tracker']; ?></li>
			<li>Send <b><?php echo $paypalOrders[$i]['User']['paypal']; ?></b> via PayPal the amount: <b>$<?php echo round($paypalOrders[$i]['Order']['totalPrice'] * .9, 2); ?></b></li>
		</ol>
		<a href="/admin/paypalorders/<?php echo $paypalOrders[$i]['Order']['id']; ?>" class="submit">Mark Completed</a>
	</div>
<?php } ?>