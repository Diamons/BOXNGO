<?php for($i=0;$i<count($listings);$i++){ ?>
	<?php if($i == 0 || $i % 4 == 0): ?>
	<div class="padded_columns row">
	<?php endif; ?>
	<div class="col-3 col-lg-3 product_item">
		<img src="<?php echo $listings[$i]['Image'][0]['url']; ?>/convert?w=245&h=183&fit=crop" />
		<a href="<?php echo $this->webroot; ?>shops/edit/<?php echo $listings[$i]['Shop']['id']; ?>" class="edit_link">Edit</a>
		<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $listings[$i]['Shop']['id']; ?>"><?php echo  $listings[$i]['Shop']['name']; ?></a>
	</div>
	<?php if($i == 3 || $i%4 == 3 || $i == count($listings)-1): ?>
	</div>
	<?php endif; ?>
<?php } ?>
