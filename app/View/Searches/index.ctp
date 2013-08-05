<?php 
$this->start('css');
echo $this->Html->css(array('searches/search', 'pages/main'));
$this->end();
?>
<div class="wrapper" id="content">
	<?php echo $this->Form->create("Search", array("class" => "custom")); ?>
	<div class="row" id="refinesearch">
		<div class="col-2 col-lg-2">
			<b>Refine Search</b>
		</div>
		<div class="col-3 col-lg-3">
			<?php if(isset($school)){
					echo $this->Form->input('Search.school', array('label' => 'Only show results from', 'type' => 'checkbox', 'value' => '1'));
				} ?>
				<div style="margin-left: 24px;">
					<i><?php echo $school['School']['name']; ?></i>
				</div>
		</div>
	</div>
	<div class="row">
		<div id="categories" class="col-3 col-lg-3">
				<?php echo $this->element('categories'); ?>
		</div>
		<div class="col-9 col-lg-9">
			<div id="currentPage"><b>Page <?php echo $this->Paginator->counter(); ?> <?php if(!empty($search)){ ?> for '<?php echo $search; ?>'<?php } ?></b></div>
		<?php if(!empty($results)){ ?>
			<?php if(isset($category)){ ?>
				<h3><?php echo $category['Category']['display_name']; ?></h3>
			<?php } ?>
			<div id="listings">
				<?php echo $this->element('four_columns_listings', array('listings' => $results));
				}else{ ?>
				<h1> Unfortunately there were no matches for that search. </h1>
				
			<?php } ?>
			</div>
			<div class="text-center">
				<ul class="pagination pagination-large">
					<?php echo $this->Paginator->first('<< first', array('tag' => 'li')); ?>
					<?php echo $this->Paginator->numbers(array('ellipsis' => false, 'tag' => 'li', 'first' => 2, 'last' => 2, 'separator' => false)); ?>
					<?php echo $this->Paginator->last('last >>', array('tag' => 'li')); ?>
				</ul>
			</div>
		</div>
	<div style="display:none;">
		<h2 style="margin: 60px 0 10px 0; font-size: 16px; text-transform: uppercase;">Similar Items</h2>
		<div id="similar">
			<div class="row contentbox-wrapper">
				<?php for($i = 0; $i< 4; $i++): ?>
				<div class="col-3 col-lg-3 similar_listing">
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
