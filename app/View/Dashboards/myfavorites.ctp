<?php $this->start('css');
echo $this->Html->css(array('searches/search', 'dashboard/favorites'));
$this->end(); ?>	
<?php if(!empty($favorites)){ ?>
		<?php for($i = 0; $i < count($favorites); $i++): ?>
		<?php if($i == 0 || $i % 4 == 0): ?>
		<div class="row">
		<?php endif; ?>
		<div class="three columns listing">
			<div class="listing_container">
				<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $favorites[$i]['Shop']['id'];?>">
				<?php if(!empty($favorites[$i]['Shop']['image'])){?>
				<img src="<?php echo $favorites[$i]['Shop']['image']; ?>/convert?w=265&h=271&fit=crop" class="image" />
				<?php } else { ?>
				<div class="image"></div>
				<?php } ?>
				</a>
				<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $favorites[$i]['Shop']['id'];?>"><?php echo nl2br(h($favorites[$i]['Shop']['name'])); ?></a></h1>
				
				<div class="listing_box"><a class="addfavoriteused" data-listingid="<?php echo $favorites[$i]['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="typicn heart" data-title="heart"></span></a></div>
				
			</div>
		</div>
		<?php if($i == 3 || $i%4 == 3 || $i == count($favorites)-1): ?>
		</div>
		<?php endif; ?>
		<?php endfor; ?>
<?php } else { ?>
	<div class="noresults">You have no favorites? :( Start searching and go add some!</div>
<?php } ?>