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
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('app');
		echo $this->Html->css('dashboard/main');
		
		echo $this->fetch('facebookMeta');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<meta property="og:image" content="http://theboxngo.com/boxngologolarge.png" />
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
	<?php echo $this->element('includes'.DS.'facebookscript'); ?>
	<div class="boxngo_wrapper">
		<?php echo $this->Form->create('Search', array('action' => 'index', 'type' => 'GET', 'inputDefaults' => array('div'=>false,'label'=>false),'class' => 'custom')); ?>
		<?php echo $this->element('layout'.DS.'header'); ?>
		<?php echo $this->Form->end(); ?>
		<?php echo $this->Session->flash(); ?>
		<div id="dashboard" class="wrapper row">
			<div class="three columns">
				<div id="dashmenu">
					<a href="/dashboard/myshop">My Shop Items</a>
					<a href="/dashboard/myfavorites">My Favorites</a>
					<a href="/dashboard/managepurchases">My Purchases</a>
					<a href="/dashboard/myorders">My Orders<?php if(isset($notifications) && $notifications > 0){echo "<span class='notification'>".$notifications."</span>";};?></a>
					<a href="/dashboard/messages">My Messages <?php if($messages > 0) { echo "<span style='color:red;'>(".$messages.")</span>"; } ?></a>
					<hr />
					<a href="/dashboard/manageaccount">Edit Profile</a>
				</div>
			</div>
			<div class="nine columns">
				<div class="dashwrapper">
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
