<?php
$this->start('css');
echo $this->Html->css(array('promotions/march2013'));
$this->end();
$this->start('scriptBottom');
	echo'<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>';
echo $this->Html->script('promotions/march2013');
$this->end();
?>
<div id="content" class="wrapper">
		<div class="clearfix about">
			<h1>Get 15% Off Your First Purchase</h1>
			It's March and along with Spring right around the corner, we've got St. Patrick's Day and Easter coming up! In appreciation of these holidays, we're releasing a special promotion for all of our loyal users. Starting today until the end of March, use our special coupon code during checkout and receive 15% off your first purchase*!

			<div class="coupon">
				<?php if($entered=="false"){ ?>
					<?php echo $this->Form->create('Entry'); ?>
					<?php echo $this->Form->input('Entry.email', array('label' => 'Enter your email to receive your coupon code!')); ?>
					<?php echo $this->Form->end('Submit'); ?>
				<?php } else { ?>
					marchmadness2013
					<div id="social">
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_reddit_large' displayText='Reddit'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_linkedin_large' displayText='LinkedIn'></span>
					</div>
				<?php } ?>
			</div>
			
			<p>*Minimum order amount must be $10.00. Promotion expires March 31st, 2013 at 11:59 PM GMT -5.</p>
		</div>		
</div>
