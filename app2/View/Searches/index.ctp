<?php 
$this->start('css');
echo $this->Html->css('searches/search');
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
			<?php if(isset($category)){ echo "<h3>".$category['Category']['display_name']."</h3>"; } ?>
			<?php for($i = 0; $i < count($results); $i++): ?>
			<?php if($i == 0 || $i % 4 == 0): ?>
			<div class="row">
			<?php endif; ?>
			<div class="three columns listing">
				<div class="listing_container">
					<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $results[$i]['Shop']['id'];?>">
					<?php if(!empty($results[$i]['Image'][0]['url'])){?>
					<img src="<?php echo $results[$i]['Image'][0]['url']; ?>/convert?w=265&h=271&fit=crop" class="image" />
					<?php } else { ?>
					<div class="image"></div>
					<?php } ?>
					</a>
					<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $results[$i]['Shop']['id'];?>"><?php echo nl2br(h($results[$i]['Shop']['name'])); ?></a></h1>
					
					<div class="listing_box">$<?php echo $results[$i]['Shop']['price']; ?></div>
					<div class="listing_box"><a class="addfavorite<?php if(!isset($auth) || empty($auth)){
					echo "disabled"; }elseif(isset($auth) && !empty($results[$i]['Favorite'])){
							$unique=true;
							for($k = 0; $k < count($results[$i]['Favorite']); $k++){
								if($results[$i]['Favorite'][$k]['user_id'] == $auth['id'])
									$unique = false;
							}
							if($unique == false){
								echo "used";
							}
						}
					?>" data-listingid="<?php echo $results[$i]['Shop']['id']; ?>" href="<?php if(!isset($auth) || empty($auth)){ echo $this->webroot."users"; } ?>"><span class="typicn heart" data-title="heart"></span></a></div>
					<div class="rating"><?php if(!empty($results[$i]['School'])){?><a href="/schools/<?php echo $results[$i]['School']['short_id']; ?>"><?php echo $results[$i]['School']['name']; ?></a><?php } ?></div>
					
				</div>
			</div>
			<?php if($i == 3 || $i%4 == 3 || $i == count($results)-1): ?>
			</div>
			<?php endif; ?>
			<?php endfor; ?>
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