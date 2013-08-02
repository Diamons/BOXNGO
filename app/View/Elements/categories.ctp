<nav>
<ul class="list-group">
	<?php for($i = 0; $i < count($layoutCategories); $i++){ ?>
		<li class="list-group-item"><a href="/browse/<?php echo  $layoutCategories[$i]['Category']['short_name']; ?>"><i class="icon-chevron-right"></i><?php echo $layoutCategories[$i]['Category']['display_name']; ?></a></li>
	<?php } ?>
</ul>
</nav>