<?php
	$this->start('css');
		echo $this->Html->css(array('searches/search', 'pages/main', 'schools/index', 'http://cdn.leafletjs.com/leaflet-0.4/leaflet.css'));
	$this->end();
	$this->start('scriptBottom');
	echo $this->Html->script(array('http://cdn.leafletjs.com/leaflet-0.4/leaflet.js'));
	/*Map Stuff */
	?>
	<script>
		$(function(){
			var map = L.map('map').setView([<?php echo $school['School']['latitude'].",".$school['School']['longitude']; ?>], 14);
			L.tileLayer('http://{s}.tile.cloudmade.com/7ced7f56137c4570ac85691831b04c56/997/256/{z}/{x}/{y}.png', {
    attribution: ''}).addTo(map);
			var popup = L.circle([<?php echo $school['School']['latitude'].",".$school['School']['longitude']; ?>], 220, {color: 'red', fillColor: '#f03', fillOpacity: 0.5}).addTo(map);
		});
	</script>
<?php
	$this->end();
	/*End Map Stuff*/
?>
<div id="content" class="wrapper">
	<div class="row">
		<div id="map"></div>
		<div class="row" id="schoolContainer">
			<div id="schoolGraphics" class="col-xs-3 col-md-3">
				<img id="schoolLogo" src="<?php echo $school['School']['emblem']; ?>" />
				<h1 id="schoolName"><?php echo $school['School']['name']; ?></h1>
				<div><?php echo $userscount; ?> Users Registered</div>
				<div><?php echo count($listings); ?> Listings</div>
			</div>
			<div class="col-xs-9 col-md-9">
				<div id="listings">
					<?php if(!empty($listings)): ?>
						<?php 
							for($i = 0; $i < count($listings); $i++):
								if($i == 0 || $i % 4 == 0): ?>
									<div class="row">
								<?php endif; ?>
									<div class="col-xs-3 col-md-3">
										<div class="listing">
											<a class="image_container" href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo $listings[$i]['Shop']['id'];?>">
											<?php if(!empty($listings[$i]['Image'][0]['url'])){?>
											<img src="<?php echo $listings[$i]['Image'][0]['url']; ?>/convert?w=182&h=150&fit=crop" class="image" />
											<?php } else { ?>
											<div class="image"></div>
											<?php } ?>
											</a>
											<h1 class="listing_title"><a href="<?php echo $this->webroot;?>shops/viewlisting/<?php echo nl2br(h($listings[$i]['Shop']['id']));?>"><?php echo nl2br(h($listings[$i]['Shop']['name'])); ?></a></h1>
											<div class="category"><span class="price">$<?php echo $listings[$i]['Shop']['price']; ?></span><a href="/searches/browse/<?php echo $listings[$i]['Category']['short_name']; ?>"><?php echo $listings[$i]['Category']['display_name']; ?></a></div>
											<div class="userlisted">
												<span class="icon-user"></span> Listed by <a href="/users/profile/<?php echo $listings[$i]['User']['id']; ?>"><?php echo $listings[$i]['User']['display_name']; ?></a>
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
</div>
