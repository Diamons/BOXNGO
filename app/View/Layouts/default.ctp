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
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('app');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<?php echo $this->fetch('facebookMeta'); ?>
	<meta property="og:image" content="//theboxngo.com/boxngologofacebook.png" />
	<?php echo $this->Html->script(array('//code.jquery.com/jquery-latest.min.js', '//code.jquery.com/ui/1.10.0/jquery-ui.js')); ?>
	
	<?php
		echo $this->fetch('script');
	?>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<?php echo $this->fetch('pinterest'); ?>
	<?php echo $this->element('includes/facebookscript'); ?>
	<div class="boxngo_wrapper">
		<?php //echo $this->element('layout'.DS.'subnav'); ?>
		<?php echo $this->element('layout'.DS.'header'); ?>
		
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		<?php echo $this->element('totop'); ?>
		<?php
			echo $this->element('sql_dump');
		?>
		<div class="push"></div>
	</div>
	<?php echo $this->element('layout'.DS.'footer'); ?>
	<?php 
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.autocomplete');
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
<!-- begin olark code -->
</body>

</html>
