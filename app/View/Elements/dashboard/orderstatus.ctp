<?php for($i = 0; $i < count($purchases); $i++){ ?>
<div class="row listing_purchase">
		<div class="three columns">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $purchases[$i]['Order']['shop_id']; ?>"><img src="<?php echo $purchases[$i]['Image']['url']; ?>/convert?w=210&h=120&fit=crop" /></a>
		</div>
		<div class="three columns">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $purchases[$i]['Order']['shop_id']; ?>"><?php echo $purchases[$i]['Shop']['name']; ?></a>
		</div>
		<div class="totalPrice one columns">
		</div>
		<div class="totalPrice two columns">
			$<?php echo $purchases[$i]['Order']['totalPrice']; ?>
		</div>
		<div class="process three columns">
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
</div>
<?php } ?>