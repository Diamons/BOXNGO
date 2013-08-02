<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/managepurchases'));
$this->end();
?>
<div id="dashmenu"><span>Manage my Orders</span></div>
<div class="dashwrapper">
	<?php for($i = 0; $i < count($orders); $i++){ ?>
	<div class="row listing_purchase">
			<div class="col-3 col-lg-3">
				<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $orders[$i]['Order']['shop_id']; ?>"><img src="<?php echo $orders[$i]['Image']['url']; ?>/convert?w=210&h=120&fit=crop" /></a>
			</div>
			<div class="col-2 col-lg-2">
				<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $orders[$i]['Order']['shop_id']; ?>"><?php echo nl2br(h($orders[$i]['Shop']['name'])); ?></a>
			</div>
			<div class="totalPrice col-2 col-lg-2">
				$<?php echo number_format($orders[$i]['Order']['totalPrice'], 2); ?>
			</div>
			<div class="process col-3 col-lg-3">
			<?php if($orders[$i]['Order']['status'] == "cancelled"){ ?>
				<div>
					<span class="current"><span class="typicn tick" data-title="tick"></span><span style="color: red;">Seller Declined</span></span>
				</div>
				<?php } else {?>
				<div>
					<span <?php if($orders[$i]['Order']['status'] == "pending"){ echo "class='current'"; } ?>><span class="typicn tick" data-title="tick"></span>Pending Acceptance</span>
				</div>
				<div>
					<span <?php if($orders[$i]['Order']['status'] == "accepted"){ echo "class='current'"; } ?>><span class="typicn tick" data-title="tick"></span>Seller Accepted</span>
				</div>
				<div>
					<span <?php if($orders[$i]['Order']['status'] == "shipped"){ echo "class='current'"; } ?>><span class="typicn forward" data-title="forward"></span>Shipped</span>
				</div>
				<div>
					<span <?php if($orders[$i]['Order']['status'] == "paid"){ echo "class='current'"; } ?>><span class="typicn heart" data-title="heart"></span>Payment Sent</span>
				</div>
			<?php } ?>
			</div>
			<div class="process col-2 col-lg-2">
				<a class="manageorderButton" href="<?php echo $this->webroot; ?>payments/manageorder/<?php echo $orders[$i]['Order']['id']; ?>">Manage Order</a>
				<a href="/users/profile/<?php echo $orders[$i]['Order']['buyer_id']; ?>" class="manageorderButton">Buyer's Profile</a>
			</div>
	</div>
	<?php } ?>
</div>
