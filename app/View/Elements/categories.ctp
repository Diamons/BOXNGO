<nav>
<div class="header">Browse Categories</div>
<ul>
	<?php for($i = 0; $i < count($layoutCategories); $i++){ ?>
		<li><a href="/browse/<?php echo  $layoutCategories[$i]['Category']['short_name']; ?>"><i class="icon-chevron-right"></i><?php echo $layoutCategories[$i]['Category']['display_name']; ?></a></li>
	<?php } ?>
</ul>
</nav>