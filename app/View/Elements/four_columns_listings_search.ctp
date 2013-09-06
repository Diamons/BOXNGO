	<?php if(!empty($listings)): ?>
			<?php 
				for($i = 0; $i < count($listings); $i++):
					if($i == 0 || $i % 4 == 0): ?>
						<div class="row">
					<?php endif; ?>
						<div class="col-3 col-lg-3">
							<div class="listing">
								<a class="thumbnail image_container" href="<?php echo $listings[$i]['ShopSearch']['full_url'] ?>">
								<?php if(!empty($listings['ShopSearch']['url'])){?>
								<img alt="<?php echo trim(h($listings[$i]['ShopSearch']['name'])); ?>" src="<?php echo $listings[$i]['ShopSearch']['url']; ?>/convert?w=250&h=205&fit=crop" class="image" />
								<?php } else { ?>
								<div class="image"></div>
								<?php } ?>
								</a>
								<h1 class="listing_title"><a href="<?php echo $listings[$i]['ShopSearch']['full_url'] ?>"><?php echo nl2br(h($listings[$i]['ShopSearch']['name'])); ?></a></h1>
								<div class="category"><span class="price">$<?php echo $listings[$i]['ShopSearch']['price']; ?></span><a href="/searches/browse/<?php echo $listings[$i]['Category']['short_name']; ?>"><?php echo $listings[$i]['Category']['display_name']; ?></a></div>
								<div class="userlisted">
									Listed by <a href="/users/profile/<?php echo $listings[$i]['ShopSearch']['user_id']; ?>"><?php echo $listings[$i]['ShopSearch']['display_name']; ?></a>
								</div>
							</div>
						</div>
				<?php if($i == 3 || $i%4 == 3 || $i == count($listings)-1): ?>
				</div>
				<?php endif; ?>
				<?php endfor;
		endif; ?>
