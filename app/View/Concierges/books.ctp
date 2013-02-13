<?php echo $this->start('css');
	echo $this->Html->css(array('searches/search', 'pages/main', 'concierges/concierge'));
	$this->end();
?>
<div id="content" class="wrapper">
	<div class="row">
		<div class="main_books nine columns">
			<h1>Books Used in <?php echo $searched['Course']['course_number']; ?> Classes</h1>
			<?php 
			if(count($books) > 0){ ?>
				<ul class="accordion">
			<?php for($i = 0; $i < count($books); $i++){ ?>
					<li <?php if($i == 0){ echo "class=\"active\""; } ?>>
						<div class="title">
							<h5><?php echo $books[$i]['title']; ?></h5>
						</div>
						<div class="content">
							<div class="row">
								<div class="book_image three columns">
									<div class="panel callout radius">
										<p>
											<?php echo $this->Book->getImage($books[$i]['isbn']); ?>
											<h1 class="subheader"><?php echo $books[$i]['title']; ?></h1>
										</p>
									</div>
								</div>
								<div class="nine columns">
									<?php if(!empty($books[$i]['listings'])): ?>
										<?php 
											for($k = 0; $k < count($books[$i]['listings']); $k++):
												if($k == 0 || $k % 3 == 0): ?>
													<div class="row">
												<?php endif; ?>
													<div class="book_listings four columns">
														<div class="listing">
															<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $books[$i]['listings'][$k]['Shop']['id'];?>">
															<?php if(!empty($books[$i]['listings'][$k]['Image'][0]['url'])){?>
															<img src="<?php echo $books[$i]['listings'][$k]['Image'][0]['url']; ?>/convert?w=182&h=150&fit=crop" class="image" />
															<?php } else { ?>
															<?php } ?>
															</a>
															<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($books[$i]['listings'][$k]['Shop']['id']));?>"><?php echo nl2br(h($books[$i]['listings'][$k]['Shop']['name'])); ?></a></h1>
															<div class="userlisted">
																<span class="typicn user"></span> <a href="/users/profile/<?php echo $books[$i]['listings'][$k]['User']['id']; ?>"><?php echo $books[$i]['listings'][$k]['User']['display_name']; ?></a>
															</div>
														</div>
													</div>
											<?php if($k == 2 || $k%3 == 2 || $k == count($books[$i]['listings'])-1): ?>
											</div>
											
											<?php endif; ?>
											<?php endfor;
									endif; ?>
								</div>
							</div>
						</div>
					</li>
			<?php
				} ?>
				</ul>
			<?php }
			?>
		</div>
		<div class="similar_classes three columns">
			<?php foreach($similar as $s){ ?>
				<div><?php echo $s['Course']['full_text']; ?></div>
			<?php } ?>
		</div>
	</div>
</div>