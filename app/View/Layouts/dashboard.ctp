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
		echo $this->Html->css('pages/main');
		echo $this->Html->css('dashboard/main');
		
		echo $this->fetch('facebookMeta');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<meta property="og:image" content="//theboxngo.com/boxngologolarge.png" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<?php
		echo $this->fetch('script');
	?>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<?php echo $this->element('includes'.DS.'facebookscript'); ?>
	<div class="boxngo_wrapper">
		<?php //echo $this->element('layout'.DS.'subnav'); ?>
		<?php echo $this->element('layout'.DS.'header'); ?>
		
		<?php echo $this->Session->flash(); ?>
		<div id="content" class="wrapper row">
			<div class="col-xs-3 col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="/dashboard/myshop">My Shop Items</a></li>
					<li><a href="/dashboard/myfavorites">My Favorites</a></li>
					<li><a href="/dashboard/managepurchases">My Purchases</a></li>
					<li><a href="/dashboard/myorders">My Orders<?php if(isset($notifications) && $notifications > 0){echo "<span class='notification'>".$notifications."</span>";};?></a></li>
					<li><a href="/dashboard/messages">My Messages <?php if($messages > 0) { echo "<span class='notification'>".$messages."</span>"; } ?></a></li>
					<hr />
					<li><a href="/dashboard/manageaccount">Edit Profile</a></li>
					<li><a href="/users/paymentinfo">Manage Payment Information</a></li>
					<hr />
					<li><a href="/dashboard/earnpoints">Earn Points</a></li>
				</ul>
			</div>
			<div class="col-xs-9 col-md-9">
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<?php
			echo $this->element('sql_dump');
		?>
		<div class="push"></div>
	</div>
	<?php echo $this->element('layout'.DS.'footer'); ?>
	<?php 
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.autocomplete.min');
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
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('2827-622-10-8378');/*]]>*/</script><noscript><a href="https://www.olark.com/site/2827-622-10-8378/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->
</body>

</html>
