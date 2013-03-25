<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="/favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<link rel="stylesheet" type="text/css" href="/css/foundation.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/app.css" />
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<meta property="og:image" content="http://theboxngo.com/logo.png" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div class="boxngo_wrapper">
	<form action="/search" class="custom" id="SearchIndexForm" method="get" accept-charset="utf-8">
	<header>
		<div class="row clearfix wrapper">
			<div id="logo">
				<a href="/"><img src="/logo.png" alt="BOX'NGO" /></a></div>
			<div id="search_container">
				<img id="searchTrigger" src="/images/search.png" />
				<input name="query" placeholder="Electronics, Textbooks, Jewelry, and more!" type="text" id="SearchQuery"/>				<input  class="mainpage" type="submit" value="Search"/>			</div>
			<div id="actions">
				<a id="register" href="/users">Return to Site →</a>
			</div>
		</div>
	</header>
	</form>	
	<div id="content">
		<div class="wrapper">
			<div class="row">
				<div class="eight columns">