<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
</div>
	</div>
</div>
<footer>
	<div class="wrapper">
		<a class="support" href="/info/support">Support</a>
		<a href="/">Home</a>
		<a href="/search">Browse</a>
		<a href="/blog">Blog</a>
		<a href="/info/about">About</a>
		<a href="/info/privacy">Privacy Policy</a>
		<!-- <a href="/info/faq">FAQ</a> -->
		
	</div>
</footer>
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
<?php wp_footer(); ?>
</body>
</html>