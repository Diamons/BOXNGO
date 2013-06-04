<?php $this->start('scriptBottom');
$this->end();
$this->start('css');
echo $this->Html->css(array('searches/search', 'pages/main', 'bootstrap.min'));
$this->end();
?>

<div id="content" class="wrapper">
	<div class="row">
		<div id="update" class="alert">
			<a href="http://theboxngo.com/blog/?p=2461"><strong>Blog Update -</strong> Current State of Affairs and Upcoming Updates</a>
		</div>
		<div id="categories" class="three columns">
			<?php echo $this->element('categories'); ?>
		<nav class="newlyListed">
			<div class="header">Newly Listed</div>

			<?php for($i = 0; $i < count($recent); $i++){ ?>
			<div class="row">
				<div class="three columns">
<<<<<<< HEAD
					<a href="<?php echo $recent[$i]['Shop']['permalink']; ?>">
						<?php echo $this->Html->image($recent[$i]['Image'][0]['url'].'/convert?w=64&height=64&fit=crop', array('class' => 'newListingImage')); ?>
=======
					<a href="<?php echo $recent[$i]['Shop']['full_url']; ?>">
						<?php echo $this->Html->image($recent[$i]['Image'][0]['url'].'/convert?w=64&height=64', array('class' => 'newListingImage')); ?>
>>>>>>> 414a852c336a7df8e6c38d24c55e37b6b6c3c42f
					</a>	
				</div>
				<div class="newlyListedInfo nine columns">
					<a class="newlyListedName" href="<?php echo $recent[$i]['Shop']['full_url']; ?>"> <?php echo $recent[$i]['Shop']['name']; ?></a>
					<div class="category"><a href="/searches/browse/<?php echo $recent[$i]['Category']['short_name']; ?>"><?php echo $recent[$i]['Category']['display_name']; ?></a></div>
					<div class="price">$123.00</div>
				</div>
			</div>
			<?php } ?>

		</nav>
		</div>
		<div class="nine columns">
			<div id="listings">
				<?php if(!empty($listings)): ?>
					<?php 
						for($i = 0; $i < count($listings); $i++):
							if($i == 0 || $i % 4 == 0): ?>
								<div class="row">
							<?php endif; ?>
								<div class="three columns">
									<div class="listing">
										<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $listings[$i]['Shop']['id'];?>/<?php echo $listings[$i]['Shop']['permalink']; ?>">
										<?php if(!empty($listings[$i]['Image'][0]['url'])){?>
										<img src="<?php echo $listings[$i]['Image'][0]['url']; ?>/convert?w=182&h=150&fit=crop" class="image" />
										<?php } else { ?>
										<div class="image"></div>
										<?php } ?>
										</a>
										<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($listings[$i]['Shop']['id']));?>/<?php echo $listings[$i]['Shop']['permalink']; ?>"><?php echo nl2br(h($listings[$i]['Shop']['name'])); ?></a></h1>
										<div class="category"><span class="price">$<?php echo $listings[$i]['Shop']['price']; ?></span><a href="/searches/browse/<?php echo $listings[$i]['Category']['short_name']; ?>"><?php echo $listings[$i]['Category']['display_name']; ?></a></div>
										<div class="userlisted">
											<span class="typicn user"></span> Listed by <a href="/users/profile/<?php echo $listings[$i]['User']['id']; ?>"><?php echo $listings[$i]['User']['display_name']; ?></a>
										</div>
									</div>
								</div>
						<?php if($i == 3 || $i%4 == 3 || $i == count($listings)-1): ?>
						</div>
						<?php endif; ?>
						<?php endfor;
				endif; ?>
			</div>
		</div>
	</div>
</div>