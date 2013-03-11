<header>
	<div class="row clearfix wrapper">
			<div id="logo"><a href="<?php echo $this->webroot;?>"><img src="/logo.png" alt="BOX'NGO" /></a></div>
			<div id="search_container">
				<img id="searchTrigger" src="/images/search.png" />
				<?php echo $this->Form->input('Search.query', array('placeholder' => 'Electronics, Textbooks, Jewelry, and more!')); ?>
				<?php echo $this->Form->submit('Search', array('class' => 'mainpage', 'div'=>false)); ?>
			</div>
			<div id="actions">
				<?php if(!isset($auth)){ ?>
					<a id="register" href="<?php echo $this->webroot;?>users">Signup</a>
					<a id="login" href="<?php echo $this->webroot;?>users">Login</a>
				<?php } else { ?>
					<div id="user_container">
						Welcome back <a href="/users/profile"><?php echo $auth['username']; ?>!</a>
						<ul id="user_menu">
							<li>
								<a href="/dashboard">
									<div class="row">
										<div class="three columns">
											<i class="icon-reorder"></i>
										</div>
										<div class="nine columns">
											<h2>Dashboard</h2>
											<div class="subtext">
												This is where you manage your listings, orders, account, favorites, and more.
											</div>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="/dashboard/messages">
									<div class="row">
										<div class="three columns">
											<i class="icon-envelope"></i>
										</div>
										<div class="nine columns">
											<h2>Inbox</h2>
											<div class="subtext">
												This is where all your messages you have sent and received are stored.
											</div>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="/users/profile">
									<div class="row">
										<div class="three columns">
											<i class="icon-user"></i>
										</div>
										<div class="nine columns">
											<h2>Profile</h2>
											<div class="subtext">
												This is where you can see your publically viewable profile.
											</div>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="/users/logout">
									<div class="row">
										<div class="three columns">
											<i class="icon-signout"></i>
										</div>
										<div class="nine columns">
											<h2>Logout</h2>
											<div class="subtext">
												Logout of BOX'NGO. Be sure to come back and visit!
											</div>
										</div>
									</div>
								</a>
							</li>
						</ul>
					</div>
				<?php } ?>
				<a id="list_item" href="/shops/shoplist">List Item</a>
			</div>
	</div>
</header>