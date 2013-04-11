<footer>
	<div class="row wrapper">
		<div class="three columns">
			<a href="/"><img src="/logo.png" /></a>
		</div>
		<div class="three columns">
			<a href="/blog/">Blog</a>
			<a href="/info/about">About</a>
		</div>
		<div class="three columns">
			<?php for($i = 0; $i < count($categories); $i++){ ?>
				<a href="/browse/<?php echo $categories[$i]['Category']['short_name']; ?>"><?php echo $categories[$i]['Category']['display_name']; ?></a>
			<?php } ?>
		</div>
		<div class="three columns">
			<a class="support" href="/info/support">Support</a>			
			<a href="/info/privacy">Privacy Policy</a>
			<!-- <a href="/info/faq">FAQ</a> -->
		</div>	
	</div>
</footer>