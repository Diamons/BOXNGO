<?php
echo $this->Html->docType();
?>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $this->Breadcrumb->pageTitle($settings['name'], array('separator' => $settings['titleSeparator'])); ?></title>
	<?php
	echo $this->Html->css('Forum.style');
	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('app');
	echo $this->Html->script('Forum.mootools-core-1.4.5');
	echo $this->Html->script('Forum.mootools-more-1.4.0.1');
	echo $this->Html->script('Forum.forum');

	echo $this->fetch('css');
	echo $this->fetch('script'); ?>
</head>

<body>
	<div class="wrapper">

		<?php echo $this->element('layout'.DS.'header'); ?>

		<div id="content" class="wrapper">
			<?php //echo $this->element('search'); ?>
			<?php echo $this->element('breadcrumbs'); ?>

			<span class="clear"></span>

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>

			<?php echo $this->element('breadcrumbs'); ?>
		</div>

		<div class="footer">
			<?php //echo $this->element('copyright'); ?>
		</div>
	</div>

	<?php if (!CakePlugin::loaded('DebugKit')) {
		//echo $this->element('sql_dump');
	} ?>
</body>
</html>