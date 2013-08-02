<header>
	<div class="row clearfix wrapper">
			<div class="col-2 col-lg-2" id="logo"><a href="<?php echo $this->webroot;?>"><img src="/logo.png" alt="BOX'NGO" /></a></div>
			<div class="col-9 col-lg-9" id="search_container">
				<i id="searchTrigger" class="icon-search"></i>
				<?php echo $this->Form->input('Search.query', array('placeholder' => 'Electronics, Textbooks, Jewelry, and more!')); ?>
				<?php echo $this->Form->submit('Search', array('class' => 'mainpage', 'div'=>false)); ?>
			</div>
			<div class="col-1 col-lg-1s" id="newListing">
				<a href="#" id="listButton">Search</a>
			</div>
	</div>
</header>
