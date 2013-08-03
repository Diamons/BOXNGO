<style>
	.navbar{
		background: transparent;
		margin-bottom: 10px;
	}
	body{
		background: #FAFAFA;
	}
	
	div#content.wrapper {
		background: #FFF;
		padding: 20px;
		border: 1px solid #F1F1F1;
		border-radius: 9px;
	}
	
	.navbar li a{
		margin-top: 5px;
		font-size: 14px;
		text-transform: uppercase;
	}
	
	.navbar li a:hover{
		border-bottom: 4px solid #CCC;
	}
	
	.navbar ul.nav{
		margin-left: 10px;
	}
	
	.navbar .user_actions{
		margin-top: 5px;
	}
</style>
<link href='http://fonts.googleapis.com/css?family=Podkova' rel='stylesheet' type='text/css'>

<div class="navbar">
  <div class="wrapper">
    <a class="navbar-brand" href="/"><img src="/logo.png" alt="BOX'NGO" /></a>
	<ul class="nav navbar-nav">
		<li><a href="/shops/shoplist">Sell</a></li>
		<?php $notifications = 3; ?>
		<li><a href="/dashboard">Dashboard<?php if(isset($notifications) && $notifications > 0){echo "<span class='notification'>".$notifications."</span>";};?></a></li>
	</ul>
	<div class="user_actions nav navbar-nav pull-right">
		<a class="btn btn-default navbar-btn" href="/users">Sign In</a>
		<a class="btn btn-primary navbar-btn" href="/users">Register</a>
	</div>
  </div>
</div>
