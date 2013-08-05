	<?php if(!empty($listings)): ?>
			<?php 
				for($i = 0; $i < count($listings); $i++):
					if($i == 0 || $i % 4 == 0): ?>
						<div class="row">
					<?php endif; ?>
						<div class="col-3 col-lg-3">
							<div class="listing">
								<a class="thumbnail image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $listings[$i]['Shop']['id'];?>/<?php echo $listings[$i]['Shop']['permalink']; ?>">
								<?php if(!empty($listings[$i]['Shop']['Image'][0]['url'])){?>
								<img alt="<?php echo trim(h($listings[$i]['Shop']['name'])); ?>" src="<?php echo $listings[$i]['Shop']['Image'][0]['url']; ?>/convert?w=250&h=205&fit=crop" class="image" />
								<?php } else { ?>
								<div class="image"></div>
								<?php } ?>
								</a>
								<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($listings[$i]['Shop']['id']));?>/<?php echo $listings[$i]['Shop']['permalink']; ?>"><?php echo nl2br(h($listings[$i]['Shop']['name'])); ?></a></h1>
								<div class="category"><span class="price">$<?php echo $listings[$i]['Shop']['price']; ?></span><a href="/searches/browse/<?php echo $listings[$i]['Shop']['Category']['short_name']; ?>"><?php echo $listings[$i]['Shop']['Category']['display_name']; ?></a></div>
								<div class="userlisted">
									Listed by <a href="/users/profile/<?php echo $listings[$i]['Shop']['User']['id']; ?>"><?php echo $listings[$i]['Shop']['User']['display_name']; ?></a>
								</div>
							</div>
						</div>
				<?php if($i == 3 || $i%4 == 3 || $i == count($listings)-1): ?>
				</div>
				<?php endif; ?>
				<?php endfor;
		endif; ?>
