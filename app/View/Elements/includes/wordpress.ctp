<?php
	App::uses('ConnectionManager', 'Model');
	$dataSource = ConnectionManager::getDataSource('default');
	$mysql = mysql_connect($dataSource->config['host'], $dataSource->config['login'], $dataSource->config['password']);
	mysql_select_db($dataSource->config['database']);
	
	if($result = mysql_query("SELECT * FROM `wp_posts` WHERE `post_status` = 'publish' AND `post_type` = 'post' ORDER BY `ID` DESC LIMIT 5")){
		while ($row = mysql_fetch_assoc($result)) { ?>
			<div class="blog_post">
				<a href="<?php echo $row['guid']; ?>"><?php echo $row['post_title']; ?></a>
				<span class="date"><?php echo $this->Time->timeAgoInWords($row['post_date'], array('format' => 'F jS, Y', 'end' => '+1 month')); ?></span>
			</div>
<?php	}

		mysql_close($mysql);
	}else{
	}
 ?>