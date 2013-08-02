<?php for($i = 0; $i < count($purchases); $i++){ ?>
<div class="row listing_purchase">
		<div class="col-3 col-lg-3">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $purchases[$i]['Order']['shop_id']; ?>"><img src="<?php echo $purchases[$i]['Image']['url']; ?>/convert?w=210&h=120&fit=crop" /></a>
		</div>
		<div class="col-2 col-lg-2">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $purchases[$i]['Order']['shop_id']; ?>"><?php echo $purchases[$i]['Shop']['name']; ?></a>
		</div>
		<div class="totalPrice col-2 col-lg-2">
			$<?php echo number_format($purchases[$i]['Order']['totalPrice'], 2); ?>
		</div>
		<div class="process col-3 col-lg-3">
			<?php if($purchases[$i]['Order']['status'] == "cancelled"){ ?>
			<div>
				<span class="current"><span class="typicn tick" data-title="tick"></span><span style="color: red;">Seller Declined</span></span>
			</div>
			<?php } else {?>
			<div>
				<span <?php if($purchases[$i]['Order']['status'] == "pending"){ echo "class='current'"; } ?>><span class="typicn tick" data-title="tick"></span>Pending Acceptance</span>
			</div>
			<div>
				<span <?php if($purchases[$i]['Order']['status'] == "accepted"){ echo "class='current'"; } ?>><span class="typicn tick" data-title="tick"></span>Seller Accepted</span>
			</div>
			<div>
				<span <?php if($purchases[$i]['Order']['status'] == "shipped"){ echo "class='current'"; } ?>><span class="typicn forward" data-title="forward"></span>Shipped</span>
			</div>
			<div>
				<span <?php if($purchases[$i]['Order']['status'] == "delivered"){ echo "class='current'"; } ?>><span class="typicn heart" data-title="heart"></span>Delivered</span>
			</div>
			<?php } ?>
		</div>
		<div class="process col-2 col-lg-2">
			<?php if(!$purchase){ ?>
				<a class="manageorderButton" href="<?php echo $this->webroot; ?>payments/manageorder/<?php echo $purchases[$i]['Order']['id']; ?>">Manage Order</a>
			<?php } else { ?>
				<a class="manageorderButton" href="/reviews/feedback/<?php echo $purchases[$i]['Order']['id']; ?>">Leave Feedback</a>
			<?php } ?>
			<a href="/users/profile/<?php echo $purchases[$i]['Shop']['user_id']; ?>" class="manageorderButton">Seller's Profile</a>
		</div>
</div>
<?php } ?>
