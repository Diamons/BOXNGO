<?php
$cakeDescription = __d('boxngo', 'BOX\'NGO');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?> - 
		<?php echo nl2br(h($title_for_layout)); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('foundation.min');
		echo $this->Html->css('typicons');
		echo $this->Html->css('app');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:image" content="http://theboxngo.com/boxngologolarge.png"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<?php
		echo $this->fetch('script');
	?>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<?php echo $this->element('includes/facebookscript'); ?>
	
	<div class="boxngo_wrapper">
		<header>
			<div class="wrapper">
				<div id="logo"><a href="<?php echo $this->webroot;?>"><!-- <img src="/logo.png" alt="BOX'NGO" /> -->RESERVATION RESOURCES</a></div>
				<div id="actions">	
					<?php if(!isset($auth)): ?>
					<?php else : ?>
						<b style="color:red;">Administrator: </b> <b><a href="<?php echo $this->webroot; ?>users/profile"><?php echo $auth['username'];?></a></b>! <span id="logout"><a href="<?php echo $this->webroot;?>users/logout">(Logout)</a></span>
					<?php endif; ?>
				</div>
			</div>
		</header>
		<?php echo $this->Session->flash(); ?>
		<div class="row wrapper">
			<div class="three columns">
				<ul>
					<li><a href="/admins/modifycategories">Modify Categories</a></li>
					<li><a href="/admins/assigncategories">Assign Items to Categories</a></li>
					<li><a href="/admins/editschools">Edit School Info</a></li>
					<li><a href="/admins/markup">Markup Calculator</a></li>
					<li><a href="/admins/paypalorders">Manage PayPal Orders <?php if($orders > 0){ ?><span class="notification"><?php echo $orders; ?></span><?php } ?></a></li>
					<li><a href="/admins/managecollections">Manage Collections</a></li>
				</ul>
			</div>
			<div class="nine columns">
				<div id="content">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
		
		<?php
			echo $this->element('sql_dump');
		?>
		<div class="push"></div>
	</div>
	<footer>
		<div class="wrapper">
			<a class="support" href="/info/support">Support</a>
			<a href="/">Home</a>
			<!-- <a href="#">Blog</a> -->
			<a href="/info/about">About</a>
			<a href="/info/privacy">Privacy Policy</a>
			<!-- <a href="/info/faq">FAQ</a> -->
			
		</div>
	</footer>
	<?php 
		echo $this->Html->script('foundation.min');
		echo $this->Html->script('app');
		echo $this->Html->script('main');
		echo $this->fetch('scriptBottom');
	?>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2509553-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>

</html>
