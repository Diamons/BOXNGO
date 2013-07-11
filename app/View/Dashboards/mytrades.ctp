<div class="dashwrapper">
	<?php for($i = 0; $i < count($trades); $i++){ ?>
		<div class="row">
			<div class="trade">
				<?php echo $trades[$i]['Shop']['name']; ?> on <?php echo $trades[$i]['Trade']['created']; ?>
			</div>
		</div>
	<?php } ?>
</div>