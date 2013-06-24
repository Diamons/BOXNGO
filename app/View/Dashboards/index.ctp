<div id="myshop">
	<a href="<?php echo $this->webroot; ?>dashboard/myshop">My Shop Items</a> <b>(<?php echo $listingsCount; ?>)</b>
	
	<div class="padded_columns row">
		<?php for($i=0;$i<count($listings);$i++){ ?>
		<div class="three columns product_item">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo h($listings[$i]['Shop']['id']); ?>">
			<img src="<?php echo nl2br(h($shopItems[$listings[$i]['Shop']['id']]['Image']['url'])); ?>/convert?w=245&h=183&fit=crop" /></a>
			<a href="<?php echo $this->webroot; ?>shops/edit/<?php echo h($listings[$i]['Shop']['id']); ?>" class="edit_link">Edit</a>
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo h($listings[$i]['Shop']['id']); ?>"><?php echo nl2br(h($shopItems[$listings[$i]['Shop']['id']]['Shop']['name'])); ?></a>
		</div>
		<?php } ?>
	</div>
</div>

<div id="myfavorites">
	<a href="<?php echo $this->webroot; ?>dashboard/myfavorites">My Favorites</a> <b>(<?php echo $favoritesCount; ?>)</b>
	
	<div class="padded_columns row">
		<?php for($i=0;$i<count($favorites);$i++){ ?>
		<div class="three columns product_item">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $favorites[$i]['Favorite']['shop_id']; ?>">
			<img src="<?php echo $shopItems[$favorites[$i]['Favorite']['shop_id']]['Image']['url']; ?>/convert?w=245&h=183&fit=crop" />
			<?php echo nl2br(h($shopItems[$favorites[$i]['Favorite']['shop_id']]['Shop']['name'])); ?>
			</a>
		</div>
		<?php } ?>
	</div>
</div>

<div style="border: none;" id="myorders">
	<a href="<?php echo $this->webroot; ?>dashboard/myorders">My Orders</a> <b>(<?php echo $ordersCount; ?>)</b>
	
	<div class="padded_columns row">
		<?php for($i=0;$i<count($orders);$i++){ ?>
		<div class="three columns product_item">
			<a href="<?php echo $this->webroot; ?>shops/viewlisting/<?php echo $orders[$i]['Order']['shop_id']; ?>"><img src="<?php echo $shopItems[$orders[$i]['Order']['shop_id']]['Image']['url']; ?>/convert?w=245&h=183&fit=crop" />
			<?php echo nl2br(h($shopItems[$orders[$i]['Order']['shop_id']]['Shop']['name'])); ?></a>
		</div>
		<?php } ?>
	</div>
</div>