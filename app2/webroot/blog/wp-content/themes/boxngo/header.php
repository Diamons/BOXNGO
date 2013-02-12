<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php wp_head(); ?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="/favicon.ico" type="image/x-icon" rel="icon" /><link rel="stylesheet" type="text/css" href="/css/foundation.min.css" /><link rel="stylesheet" type="text/css" href="/css/typicons.css" /><link rel="stylesheet" type="text/css" href="/css/app.css" />
	<link rel="stylesheet" type="text/css" href="/css/pages/main.css" />
	<meta property="og:image" content="http://theboxngo.com/boxngologolarge.png"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
	#content{
		margin-top: 20px;
	}
	</style>
</head>

<div class="boxngo_wrapper">
	<header>
	<div class="row clearfix wrapper">
		<div class="one columns">
			<div id="logo"><a href="/"><img src="/logo.png" alt="BOX'NGO"></a></div>
		</div>
		<div id="search_container" class="five columns">
			<div class="row">
				<div class="eight columns">
					<input name="query" placeholder="Electronics, Textbooks, Jewelry, and more!" type="text" id="SearchQuery">				</div>
				<div class="three columns">
					<input class="mainpage" type="submit" value="Search">				</div>
			</div>
		</div>
		<div class="four columns">
			<div id="actions">	
				<a id="login" href="/users">Login</a>
				<a id="register" href="/users">Signup</a>
			</div>
		</div>
		<div class="two columns">
			<a href="/shops/shoplist" id="sell" class="link sell_link"><i class="icon-edit"></i> New Listing</a>
		</div>
	</div>
</header><!-- #masthead -->

	<div id="main" class="wrapper">