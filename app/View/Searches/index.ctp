<?php 
$this->start('css');
echo $this->Html->css(array('searches/search', 'pages/main'));
$this->end();
?>
<div class="wrapper" id="content">
	<?php echo $this->Form->create("Search", array("class" => "custom")); ?>
	<div class="row" id="refinesearch">
		<div class="two columns">
			<b>Refine Search</b>
		</div>
		<div class="three columns">
			<?php if(isset($school)){
					echo $this->Form->input('Search.school', array('label' => 'Only show results from', 'type' => 'checkbox', 'value' => '1'));
				} ?>
				<div style="margin-left: 24px;">
					<i><?php echo $school['School']['name']; ?></i>
				</div>
		</div>
	</div>
	<?php if(!empty($results)){ ?>
			<?php if(isset($category)){ ?>
				<h3><?php echo $category['Category']['display_name']; ?></h3>
			<?php } ?>
			<div id="listings">
				<?php if(!empty($results)): ?>
					<?php 
						for($i = 0; $i < count($results); $i++):
							if($i == 0 || $i % 4 == 0): ?>
								<div class="row">
							<?php endif; ?>
								<div class="three columns">
									<div class="listing">
										<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $results[$i]['Shop']['id'];?>">
										<?php if(!empty($results[$i]['Image'][0]['url'])){?>
										<img src="<?php echo $results[$i]['Image'][0]['url']; ?>/convert?w=364&h=300&fit=crop" class="image" />
										<?php } else { ?>
										<div class="image"></div>
										<?php } ?>
										</a>
										<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($results[$i]['Shop']['id']));?>"><?php echo nl2br(h($results[$i]['Shop']['name'])); ?></a></h1>
										<div class="category"><span class="price">$<?php echo $results[$i]['Shop']['price']; ?></span><a href="/searches/browse/<?php echo $results[$i]['Category']['short_name']; ?>"><?php echo $results[$i]['Category']['display_name']; ?></a></div>
										<div class="userlisted">
											<span class="typicn user"></span> Listed by <a href="/users/profile/<?php echo $results[$i]['User']['id']; ?>"><?php echo $results[$i]['User']['display_name']; ?></a>
										</div>
									</div>
								</div>
						<?php if($i == 3 || $i%4 == 3 || $i == count($results)-1): ?>
						</div>
						<?php endif; ?>
						<?php endfor;
				endif; ?>
			</div>
	<?php } else { ?>
		<h1> Unfortunately there were no matches for that search. </h1>
		
	<?php } ?>
	<div style="display:none;">
		<h2 style="margin: 60px 0 10px 0; font-size: 16px; text-transform: uppercase;">Similar Items</h2>
		<div id="similar">
			<div class="row contentbox-wrapper">
				<?php for($i = 0; $i< 4; $i++): ?>
				<div class="three columns similar_listing">
					<div class="similar_container">
						<img style="width:200px; height: 128px;" src="https://sphotos-b.xx.fbcdn.net/hphotos-ash3/78162_295114220592958_1155000282_o.jpg" />
					</div>
					<a style="padding-right: 19px; font-weight: 700; font-size: 12px; display: block; text-align: center; " href="#">Similar Picture Here</a>
				</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>