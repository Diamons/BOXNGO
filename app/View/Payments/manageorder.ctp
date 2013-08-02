<?php $this->start('css');
echo $this->Html->css('dashboard/manageorder'); 
$this->end();
?>
<div id="content" class="wrapper">
	<div class="row">
		<div class="clearfix steps_container col-9 col-lg-9">
			<div <?php if($step >=1){ echo "style='background: #47ABE5;'"; }?> class="clearfix">
				<h1 class="step">STEP 1</h1>
				<div class="info_panel">
					<h2>Accept or Cancel</h2>
					You will need to accept or decline the order to continue. If you choose to decline, the user will be notified and you will automatically be left a notice in your public profile. In addition, if your listing was deactivated because it ran out of stock, it will be reactivated.
					
					<div class="actions">
						<?php
							if($step == 0) { ?><a href="<?php echo $this->webroot."payments/manageorder/".$order['Order']['id']; ?>/accept">Accept</a><a href="<?php echo $this->webroot."payments/manageorder/".$order['Order']['id']; ?>/cancel" class="cancel">Cancel</a><?php }?>
						<?php if($step == 1){ ?><span class="cancelled">Cancelled</span><?php } ?>
						<?php if($step >=2){ ?><span class="accepted">Accepted</span><?php } ?>
					</div>
				</div>
			</div>
			<?php if($step != 1){ ?>
				<div <?php if($step < 2) { echo "style='background: #888;'"; } elseif($step > 2){ echo "style='background: #47ABE5;'"; } ?> class="clearfix">
				<h1 class="step">STEP 2</h1><div class="info_panel">
					<h2>Ship your Order via <b><a href="http://ups.com/">UPS</a> - <a href="http://fedex.com">Fedex</a> - <a href="http://usps.com/">USPS</a></b></h2>
					<p style="font-size: 11px;">Proceed to the local post office to begin to ship your order. If you don't have any available boxes to package your items, you may reuse boxes and remove / cross out the previous sender and receiver to replace it with your own. In addition, we recommend you package sensitive packages with bubble wrap, packing paper, packing peanuts, or foam. Boxes and packaging supplies can be found at most shipping facilities. If you have any problems with shipping, you may contact Support at any time for assistance.</p>
					
					<p style="font-size: 11px;">
						<b>You must purchase a tracking code from UPS, Fedex, or USPS and place it in the field below. A tracking code helps protect both the seller and the buyer in case any issues occur.</b>
					</p>
					
					<div class="actions">
						<?php if($step == 2){ ?>
						<?php echo $this->Form->create('Payments', array('action' => 'manageorder/'.$order['Order']['id'].'/ship', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
							<div class="row">
								<div class="col-10 col-lg-10">
									<?php echo $this->Form->input('Order.tracking_code'); ?>
								</div>
								<div class="col-2 col-lg-2">
									<?php echo $this->Form->end('Submit'); ?>
								</div>
							</div>
						</form>
						<?php } ?>
					</div>
				</div>
				</div>
				<div <?php if($step >3){ echo "style='background: #47ABE5;'"; } elseif ($step < 3) { echo "style='background: #888;'"; }?> class="clearfix">
					<h1 class="step">STEP 3</h1>
					<div class="info_panel">
						<h2>Wait for Payment</h2>
						Once everything goes well, simply wait until the tracker confirms your order has shipped and your funds will be deposited to your Paypal account immediately or a check will be mailed to you within 2 weeks, depending on how you selected to get paid.
						
					</div>
				</div>
			<?php } ?>
		</div>
		<div id="ordersummary" class="col-3 col-lg-3">
			<h1>Order Summary</h1>
			<div><div class="value"><?php echo $order['Order']['status']; ?></div><b>Status</b></div>
			<div><div class="value"><?php echo $order['Order']['created']; ?></div> Date Placed </div>
			<div class="clearfix"><div class="value"><a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $order['Shop']['id']; ?>"><?php echo $order['Shop']['name']; ?></a></div> Bought </div>
			<div class="clearfix"><div class="value"><?php echo $order['Payment']['firstName']; ?> <?php echo $order['Payment']['lastName']; ?><br /><?php echo $order['Payment']['streetAddress']; ?><br /><?php echo $order['Payment']['city']; ?> , <?php echo $order['Payment']['state']; ?> <?php echo $order['Payment']['zipcode']; ?></div> Shipping Info </div>
			<div class="pricinginfo clearfix"><div class="value"><?php echo $order['Payment']['shipping_amount']; ?></div> Shipping </div>
			<div class="pricinginfo clearfix"><div class="value">$<?php echo $order['Payment']['shop_amount']; ?></div> Purchase Amount </div>
			<div style="color: #0099e0" class="pricinginfo clearfix"><div class="value">$<?php echo number_format($order['Payment']['shop_amount'] + $order['Payment']['shipping_amount'], 2); ?></div> TOTAL </div>
			
		</div>
	</div>
	
</div>
