<header>
	<div class="row clearfix wrapper">
			<div class="one columns" id="logo"><a href="<?php echo $this->webroot;?>"><img src="/logo.png" alt="BOX'NGO" /></a></div>
			<div class="ten columns" id="search_container">
				<i id="searchTrigger" class="icon-search"></i>
				<?php echo $this->Form->input('Search.query', array('placeholder' => 'Electronics, Textbooks, Jewelry, and more!')); ?>
				<?php echo $this->Form->submit('Search', array('class' => 'mainpage', 'div'=>false)); ?>
			</div>
			<div class="one columns" id="newListing">
				<a href="#" id="listButton">Sell</a>
			</div>
	</div>
</header>