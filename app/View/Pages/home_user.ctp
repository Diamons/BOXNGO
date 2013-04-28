<?php $this->start('scriptBottom');
$this->end();
$this->start('css');
echo $this->Html->css(array('searches/search', 'pages/main'));
$this->end();
?>
<div id="content" class="wrapper">
	<div class="row">
		<div id="categories" class="three columns">
			<nav>
				<div class="header"><span class="typicn feed"></span> Categories</div>
				<ul>
					<?php for($i = 0; $i < count($layoutCategories); $i++){ ?>
						<li><a href="/browse/<?php echo  $layoutCategories[$i]['Category']['short_name']; ?>"><?php echo $layoutCategories[$i]['Category']['display_name']; ?></a></li>
					<?php } ?>
				</ul>
			</nav>
			<div id="blogposts">
				<?php echo $this->element('includes'.DS.'wordpress'); ?>
			</div>
		</div>
		<div class="nine columns">
			<?php //<a href="/promotions/march2013"><img id="coverBanner" src="/images/cover.png?promo=march2013" /></a> ?>
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