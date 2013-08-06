<?php echo $this->Html->css(array('pages/main')); ?>
<style>
	#content.wrapper{
		border-radius: 9px;
		border: 1px solid #DDD;
	}
	
	h1{
		font-size: 22px;
	}
	
	.orderSummary{
		padding-left: 20px;
	}
	
	.starRatings{
		display: inline-block;
	}
	
	.ratingSection{
		margin: 20px 0;
	}
</style>
<?php $this->start('css'); ?>
	<?php echo $this->Html->css('jRating.jquery'); ?>
<?php $this->end(); ?>
<?php $this->start('scriptBottom'); ?>
	<?php echo $this->Html->script(array('jRating.jquery', 'feedback')); ?>
<?php $this->end(); ?>
<?php debug($order['Payment']); ?>
<div id="content" class="wrapper">
	<div class="row">
		<div class="col-8 col-lg-8">
			<h1>Seller Summary</h1>
			<div class="row">
				<div class="col-4 col-lg-4">
					<a class="thumbnail" href="/users/profile/<?php echo $order['User']['id']; ?>"><?php echo $this->Html->image($order['User']['profilepic']); ?></a>
				</div>
				<div class="col-8 col-lg-8">
					<table class="table">
						<tr>
							<td>Username</td>
							<td><a href="<?php echo $order['User']['id']; ?>"><?php echo h($order['User']['display_name']); ?></a></td>
						</tr>
						<tr>
							<td>Registered</td>
							<td><?php echo $this->Time->timeAgoInWords($order['User']['created'], array('format' => 'F jS, Y', 'end' => '+1 year')); ?></td>
						</tr>
						<tr>
							<td>Total Listings</td>
							<td><?php echo $shopCount; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<hr />
			<h1>Leave Seller Feedback</h1>
			<p>Seller feedback helps establish reputation amongst the community and helps sellers stay motivated. Sellers appreciate receiving feedback and it helps other buyers make choices when choosing to purchase a listing. Be fair, be honest, and above all be genuine.</p>
			<?php echo $this->Form->create("Review"); ?>
			<div style="display:none;">
			<?php
				$options = array('1' => '1 Star', '2' => '2 Stars', '3' => '3 Stars', '4' => '4 Stars', '5' => '5 Stars', '6' => '6 Stars', '7' => '7 Stars', '8' => '8 Stars', '9' => '9 Stars', '10' => '10 Stars');
				echo $this->Form->radio("Review.rating", $options);
			?>
			</div>
			<?php if(!$review){ ?>
				<div class="ratingSection">
					<b>Your Rating: </b> <div class="starRatings" data-average="10" data-id="1"></div>
				</div>

				<?php echo $this->Form->textarea("Review.message", array("placeholder" => "Please describe your overall experience with this seller including speed, satisfaction, clarity, and anything else you find relevant.", "class" => "form-control")); ?>
				<?php echo $this->Form->end("Submit Feedback"); ?>
			<?php }else{ ?>
				<div class="ratingSection">
					<b>Your Rating: </b> <?php for($i = 0; $i < $review['Review']['rating']; $i++){ ?><i class="icon-star"></i><?php } ?>
					<p>
						<?php echo $review['Review']['message']; ?>
					</p>
				</div>
			<?php } ?>
		</div>
		<div class="orderSummary col-4 col-lg-4">
			<h1>Order Summary</h1>
			<div class="row">
				<div class="col-4 col-lg-4">
					<a class="thumbnail" href="<?php echo $order['Shop']['full_url']; ?>">
						<?php echo $this->Html->image($order['Image']['url']); ?>
					</a>
				</div>
				<div class="col-8 col-lg-8">
					<a href="<?php echo $order['Shop']['full_url']; ?>"><?php echo $order['Shop']['name']; ?></a>
				</div>
			</div>
			<table style="margin-top:20px;" class="table">
				<tr>
					<td>Price</td><td>$<?php echo number_format($order['Shop']['price'], 2); ?></td>
				</tr>
				<tr>
					<td>Shipping</td><td>$<?php echo number_format($order['Shop']['shipping'], 2); ?></td>
				</tr>
				<tr>
					<td>Total</td><td>$<?php echo number_format($order['Order']['totalPrice'], 2); ?></td>
				</tr>
				<tr>
					<td>Tracking Code</td><td><?php echo $order['Order']['tracking_code']; ?></td>
				</tr>
				<tr>
					<td>Carrier</td><td><?php echo $order['Order']['carrier']; ?></td>
				</tr>
				<tr>
					<td>Shipping Address</td>
					<td>
							<?php echo $order['Payment']['streetAddress']; ?><br />
							<?php if(isset($order['Payment']['streetAddress2'])){ ?>
								<?php echo $order['Payment']['streetAddress2']; ?><br />
							<?php } ?>
							<?php echo $order['Payment']['city']; ?>, <?php echo $order['Payment']['state']; ?> <?php echo $order['Payment']['zipcode']; ?>
					</td>
				</tr>
			</table>
			<h1>Payment Summary</h1>
			<table class="table">
				<tr>
					<td>Date</td><td><?php echo $this->Time->format('F jS, Y h:i A', $order['Payment']['created'], NULL, '-0500'); ?> (EST GMT -5)</td>
				</tr>
				<tr>
					<td>Card Number</td><td><?php echo $order['Stripe']->card['type']; ?> **** - **** - **** - <?php echo $order['Stripe']->card['last4']; ?></td>
				</tr>
				<tr>
					<td>Name</td><td><?php echo $order['Stripe']->card['name']; ?></td>
				</tr>
				<tr>
					<td>Billing Address</td>
					<td>
							<?php echo $order['Stripe']->card['address_line1']; ?><br />
							<?php if($order['Stripe']->card['address_line2']){ ?>
								<?php echo $order['Stripe']->card['address_line2']; ?><br />
							<?php } ?>
							<?php echo $order['Stripe']->card['address_city']; ?>, <?php echo $order['Stripe']->card['address_state']; ?> <?php echo $order['Stripe']->card['address_zip']; ?> <?php echo $order['Stripe']->card['address_country']; ?>
					</td>
				</tr>
				<tr>
					<td>Carrier</td><td><?php echo $order['Order']['carrier']; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
