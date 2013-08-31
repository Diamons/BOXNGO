<?php
	$this->start('css');
	echo $this->Html->css('payments/pay');
	$this->end();
	$this->start('scriptBottom');
	echo $this->Html->script('payments/pay');
	$this->end();
?>

<div class="wrapper" id="content">
		<div id="summary">	
			<div class="row">
				<div class="col-4 col-lg-4">
					<a class="thumbnail" href="<?php echo $listing['Shop']['full_url']; ?>"><?php echo $this->Html->image($listing['Image'][0]['url'], array('style' => 'display:block;', 'data-src' => $listing['Image'][0]['url'], 'alt' => h($listing['Shop']['name']))); ?></a>
				</div>
				<div class="col-8 col-lg-8">
					<a href="<?php echo $listing['Shop']['full_url']; ?>"><?php echo nl2br(h($listing['Shop']['name'])); ?></a>
					<div class="description"><?php echo h($listing['Shop']['description']); ?></div>
				</div>
			</div>
			<h1 class="header">Purchase Summary</h1>
			<div class="row">
				<div class="col-4 col-lg-4">Shipping</div>
				<div class="col-8 col-lg-8"><b>$<?php echo $listing['Shop']['shipping']; ?></b></div>
			</div>
			<div class="row">
				<div class="col-4 col-lg-4">Price</div>
				<div class="col-8 col-lg-8"><b>$<?php echo $listing['Shop']['price']; ?></b></div>
			</div>
			<?php if($price['applied'] == true){ ?>
			<div class="coupon_applied row">
				<div class="col-4 col-lg-4">Coupon</div>
				<div class="col-8 col-lg-8"><b>-$<?php echo number_format($price['Price']['discount'], 2); ?></b></div>
			</div>
			<?php } ?>
			<div class="total row">
				<div class="col-4 col-lg-4">Total</div>
				<div class="col-8 col-lg-8"><b>$<?php echo number_format($price['Price']['total_price'], 2); ?></b></div>
			</div>
		</div>
	<div class="row">
		<div>
			<?php echo $this->Form->create('Payment', array('id' => 'PaymentForm', 'data-coupon' => '/payments/pay/'.$listing['Shop']['id'], 'action' => 'process/'.$listing['Shop']['id'])); ?>
			<div id="shipping_pane">
				<h1 class="subheader">1. Shipping Information</h1>
				<div class="row">
					<div class="col-6 col-lg-6"><?php echo $this->Form->input('Payment.firstName', array('class' => 'form-control')); ?></div>
					<div class="col-6 col-lg-6"><?php echo $this->Form->input('Payment.lastName', array('class' => 'form-control')); ?></div>
				</div>
				<div class="row">
					<div class="col-4 col-lg-4"><?php echo $this->Form->input('Payment.streetAddress', array('class' => 'form-control')); ?></div>
					<div class="col-4 col-lg-4"><?php echo $this->Form->input('Payment.city', array('class' => 'form-control')); ?></div>
					<div class="col-2 col-lg-2"><?php echo $this->Form->input('Payment.state', array('class' => 'form-control')); ?></div>
					<div class="col-2 col-lg-2"><?php echo $this->Form->input('Payment.zipcode', array('class' => 'form-control', 'label' => 'Postal or Zip Code')); ?></div>
				</div>
			</div>
			<div id="payment_options">
				<div class="clearfix payment_container">
					<h1 class="subheader">2. Payment Options</h1>
					<div class="row">
						<div class="col-11 col-lg-11">
							<?php if($price['applied'] == FALSE){ ?>
								<?php echo $this->Form->input('Coupon.code', array('class' => 'form-control')); ?>
							<?php }else{ ?>
								<?php echo $price['Price']['message']; ?>
								<?php echo $this->Form->hidden('Coupon.code', array('label' => 'Coupon Code', 'class' => 'form-control')); ?>
							<?php } ?>
						</div>
						<div class="col-1 col-lg-1">
							<?php if($price['applied'] == FALSE){ ?>
								<a href="#" id="applyCoupon">Apply</a>
							<?php } ?>
						</div>
					</div>
					<div class="stripe_button">
						<script src="https://button.stripe.com/v1/button.js" class="stripe-button"
						  data-key="<?php echo $stripekey; ?>"
						  data-address="true" 
						  data-image="<?php echo $listing['Image'][0]['url']; ?>"
 						  data-amount="<?php echo ($price['Price']['total_price'] * 100); ?>" 
						  data-name="<?php echo h($listing['Shop']['name']); ?>"
						  data-description="Purchasing from user <?php echo $listing['User']['display_name']; ?> at TheBOXNGO.com"
						  >
						</script>
					</div>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		
	</div>
</div>
