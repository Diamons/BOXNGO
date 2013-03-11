<?php
	$this->start('css');
	echo $this->Html->css('payments/pay');
	$this->end();
	$this->start('scriptBottom');
	echo $this->Html->script('payments/pay');
	$this->end();
?>

<div class="wrapper" id="content">
	<div class="row">
		<div class="nine columns">
			<?php echo $this->Form->create('Payment', array('id' => 'PaymentForm', 'data-coupon' => '/payments/pay/'.$listing['Shop']['id'], 'action' => 'process/'.$listing['Shop']['id'])); ?>
			<div id="shipping_pane">
				<h1 class="subheader">1. Shipping Information</h1>
				<div class="row">
					<div class="six columns"><?php echo $this->Form->input('Payment.firstName'); ?></div>
					<div class="six columns"><?php echo $this->Form->input('Payment.lastName'); ?></div>
				</div>
				<div class="row">
					<div class="four columns"><?php echo $this->Form->input('Payment.streetAddress'); ?></div>
					<div class="four columns"><?php echo $this->Form->input('Payment.city'); ?></div>
					<div class="two columns"><?php echo $this->Form->input('Payment.state'); ?></div>
					<div class="two columns"><?php echo $this->Form->input('Payment.zipcode', array('type' => 'text')); ?></div>
				</div>
			</div>
			<div id="payment_options">
				<div class="clearfix payment_container">
					<h1 class="subheader">2. Payment Options</h1>
					<div class="row">
						<div class="eleven columns">
							<?php if($price['applied'] == FALSE){ ?>
								<?php echo $this->Form->input('Coupon.code'); ?>
							<?php }else{ ?>
								<?php echo $price['Price']['message']; ?>
							<?php } ?>
						</div>
						<div class="one columns">
							<?php if($price['applied'] == FALSE){ ?>
								<a href="#" id="applyCoupon">Apply</a>
							<?php } ?>
						</div>
					</div>
					<div class="stripe_button">
						<script src="https://button.stripe.com/v1/button.js" class="stripe-button"
						  data-key="<?php echo $stripekey; ?>"
						  data-image="<?php echo $listing['Image'][0]['url']; ?>"
 						  data-amount="<?php echo ($price['Price']['total_price'] * 100); ?>" 
						  data-name="<?php echo h($listing['Shop']['name']); ?>"
						  data-description="<?php echo h($listing['Shop']['description']); ?>"
						  >
						</script>
					</div>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>

		<div class="three columns">
			<div id="summary">
					<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $listing['Shop']['id']; ?>"><?php echo nl2br(h($listing['Shop']['name'])); ?></a>
				<h1 class="header">Purchase Summary</h1>
				<div class="row">
					<div class="four columns">Shipping</div>
					<div class="eight columns"><b>$<?php echo $listing['Shop']['shipping']; ?></b></div>
				</div>
				<div class="row">
					<div class="four columns">Price</div>
					<div class="eight columns"><b>$<?php echo $listing['Shop']['price']; ?></b></div>
				</div>
				<?php if($price['applied'] == true){ ?>
				<div class="coupon_applied row">
					<div class="four columns">Coupon</div>
					<div class="eight columns"><b>-$<?php echo number_format($listing['Shop']['price'] - $price['Price']['total_price'], 2); ?></b></div>
				</div>
				<?php } ?>
				<div class="total row">
					<div class="four columns">Total</div>
					<div class="eight columns"><b>$<?php echo number_format($price['Price']['total_price'], 2); ?></b></div>
				</div>
			</div>
		</div>
		
	</div>
</div>