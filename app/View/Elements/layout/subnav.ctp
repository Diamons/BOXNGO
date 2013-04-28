<nav id="subnav">
	<div class="wrapper">
		<a href="/">Home</a>
		<?php if(isset($auth)){ ?>
		<a href="/dashboard">Dashboard</a>
		<a href="/dashboard/messages">Inbox <?php if($messages > 0) { echo "<span class='notification'>".$messages."</span>"; } ?></a>
		<a href="/users/profile">My Profile</a>
		<?php } ?>
		<!-- <a href="#">Make a Request</a> -->
		<a href="/blog/">Blog</a>
					
				<?php if(!isset($auth)){ ?>
					<a id="register" href="<?php echo $this->webroot;?>users">Register</a>
					<a id="login" href="<?php echo $this->webroot;?>users">Login</a>
				<?php } else { ?>
				<div id="actions">
					<a id="logout" href="/users/logout">Logout</a>
					<div id="user_container">
						<a href="/users/profile">Welcome back <?php echo $auth['username']; ?>!</a>
						<ul id="user_menu">
							<li>
								<a href="/dashboard">
									<i class="icon-reorder"></i>
									<h2>Dashboard</h2>
								</a>
							</li>
							<li>
								<a href="/dashboard/messages">
									<i class="icon-envelope"></i>
									<h2>Inbox</h2>
								</a>
							</li>
							<li>
								<a href="/users/profile">
									<i class="icon-user"></i>
									<h2>Profile</h2>
								</a>
							</li>
							<li>
								<a href="/users/logout">
									<i class="icon-signout"></i>
									<h2>Logout</h2>
								</a>
							</li>
						</ul>
					</div>
				</div>
			<?php } ?>
	</div>
</nav>