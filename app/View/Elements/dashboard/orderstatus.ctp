<?php $modals = array(); ?>

<?php for($i = 0; $i < count($purchases); $i++){ ?>
<div class="row listing_purchase">
		<div class="col-3 col-lg-3">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $purchases[$i]['Order']['shop_id']; ?>"><img src="<?php echo $purchases[$i]['Image']['url']; ?>/convert?w=210&h=120&fit=crop" /></a>
		</div>
		<div class="col-2 col-lg-2">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $purchases[$i]['Order']['shop_id']; ?>"><?php echo h($purchases[$i]['Shop']['name']); ?></a>
		</div>
		<div class="totalPrice col-2 col-lg-2">
			$<?php echo number_format($purchases[$i]['Order']['totalPrice'], 2); ?>
		</div>
		<div class="process col-3 col-lg-3">
			<?php if($purchases[$i]['Order']['status'] == "cancelled"){ ?>
			<div>
				<span class="current"><span style="color: red;">Seller Declined</span></span>
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
			<?php } else {
					if($purchases[$i]['Order']['status'] == "delivered") { ?>
						<a class="manageorderButton" href="/reviews/feedback/<?php echo $purchases[$i]['Order']['id']; ?>">Leave Feedback</a>
				<?php } ?>
			<?php } ?>
			<?php if($purchases[$i]['Order']['status'] == "shipped" || $purchases[$i]['Order']['status'] == "delivered" || $purchases[$i]['Order']['status'] == "paid") { ?>
				<a class="manageorderButton" data-toggle="modal" href="#purchase<?php echo $i; ?>">Track Package</a>
				<?php $modals[$i]['tracking_code'] = $purchases[$i]['Order']['tracking_code'];
					  $modals[$i]['carrier'] = $purchases[$i]['Order']['carrier'];
					  $modals[$i]['name'] = $purchases[$i]['Shop']['name'];
					  $modals[$i]['number'] = $i;
					  $modals[$i]['link'] = "http://theboxngo.com/shops/viewlisting/".$purchases[$i]['Shop']['id']."/".$purchases[$i]['Shop']['permalink'];
				?>
			<?php } ?>
			<a href="/users/profile/<?php echo $purchases[$i]['Shop']['user_id']; ?>" class="manageorderButton">Seller's Profile</a>
		</div>
</div>
<?php } ?>

<?php foreach($modals as $key){ ?>
	<div class="modal fade" id="purchase<?php echo $key['number']; ?>" tabindex="-1" role="dialog" aria-labelledby="purchase<?php echo $key['number']; ?>Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Package Tracking Info</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-info">Use the carrier's website and insert your tracking code to track your package.</div>
					<table class="table">
						<tr>
							<td><b>Package:</b></td>
							<td><a href="<?php echo $key['link']; ?>"><?php echo h($key['name']); ?></a></td>
						</tr>
						<tr>
							<td><b>Carrier:</b></td>
							<td><?php echo ucfirst($key['carrier']); ?></td>
						</tr>
						<tr>
							<td><b>Tracking Code:</b></td>
							<td><?php echo h($key['tracking_code']); ?></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
