<?php echo $this->start('css');
	echo $this->Html->css(array('searches/search', 'pages/main', 'concierges/concierge'));
	$this->end();
?>
<div id="content" class="wrapper bordered">
	<div class="row">
		<div class="main_books col-xs-9 col-md-9">
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
								<div class="book_image col-xs-3 col-md-3">
									<div class="panel callout radius">
										<p>
											<?php echo $this->Book->getImage($books[$i]['isbn']); ?>
											<h1 class="subheader"><?php echo $books[$i]['title']; ?></h1>
										</p>
									</div>
								</div>
								<div class="col-xs-9 col-md-9">
									<?php if(!empty($books[$i]['listings'])): ?>
										<?php 
											for($k = 0; $k < count($books[$i]['listings']); $k++):
												if($k == 0 || $k % 3 == 0): ?>
													<div class="row">
												<?php endif; ?>
													<div class="book_listings col-xs-4 col-md-4">
														<div class="listing">
															<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $books[$i]['listings'][$k]['Shop']['id'];?>">
															<?php if(!empty($books[$i]['listings'][$k]['Image'][0]['url'])){?>
															<img src="<?php echo $books[$i]['listings'][$k]['Image'][0]['url']; ?>/convert?w=182&h=150&fit=crop" class="image" />
															<?php } else { ?>
															<?php } ?>
															</a>
															<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($books[$i]['listings'][$k]['Shop']['id']));?>"><?php echo nl2br(h($books[$i]['listings'][$k]['Shop']['name'])); ?></a></h1>
															<div class="userlisted">
																<div class="category"><span class="price">$<?php echo $books[$i]['listings'][$k]['Shop']['price']; ?></span></div>
																<span class="icon-user"></span> <a href="/users/profile/<?php echo $books[$i]['listings'][$k]['User']['id']; ?>"><?php echo $books[$i]['listings'][$k]['User']['display_name']; ?></a>
															</div>
														</div>
													</div>
											<?php if($k == 2 || $k%3 == 2 || $k == count($books[$i]['listings'])-1): ?>
											</div>
											
											<?php endif; ?>
											<?php endfor;
									endif; ?>
									<div class="row">
										<a class="usermessage" href="/shops/shoplist">List One Like This</a>
									</div>
								</div>
							</div>
						</div>
					</li>
			<?php
				} ?>
				</ul>
			<?php }
			?>
			<div class="fb-comments" data-href="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" data-num-posts="2" data-width="814"></div>
		</div>
		<div class="similar_classes col-xs-3 col-md-3">
			<?php foreach($similar as $s){ ?>
				<div><?php echo $s['Course']['full_text']; ?></div>
			<?php } ?>
		</div>
	</div>
</div>
