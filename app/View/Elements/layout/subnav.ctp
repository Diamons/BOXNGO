<nav id="subnav">
	<div class="wrapper">
		<?php if(isset($auth)){ ?>
		<a href="/dashboard">Dashboard</a>
		<a href="/dashboard/messages">Inbox</a>
		<a href="/users/profile">My Profile</a>
		<?php } ?>
		<!-- <a href="#">Make a Request</a> -->
		<a href="/blog">Blog</a>
	</div>
</nav>