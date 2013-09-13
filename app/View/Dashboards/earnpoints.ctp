<?php $this->start('css');
echo $this->Html->css(array('jquery.countdown', 'dashboard/earnpoints'));
$this->end();
$this->start('scriptBottom');
echo $this->Html->script(array('jquery.countdown.min', 'dashboard/rewards'));
$this->end();
?>

<h3>Earn Points and Redeem Prizes</h3>
<p>Earn BOX'NGO points (Millz) by accomplishing certain tasks across the site and have Millz added to your account. Millz can be used in various ways such as to promote ranks, gain badges and awards on your profile, gain extra promotion for your listings, earn discounts, and much more. </p>

<div class="row" id="referFriend">
	<div class="col-8 col-lg-8">
		<h4>Refer a Friend, Earn Free Bonus Millz</h4>
		<div><input class="form-control" type="text" value="http://theboxngo.com/users/referral/<?php echo $auth['id']; ?>" /></div>
		<ol>
			<li>Encourage your friends to signup using the above link.</li>
			<li>Receive 10% of all Millz that your friends earn.</li>
		</ol>
	</div>
	<div id="friends" class="row col-4 col-lg-4">
		<div class="col-6 col-lg-6">
			<h2>0</h2>
			<span class="stat">Friends </span>
		</div>
		<div class="col-6 col-lg-6">
			<h2>0</h2>
			<span class="stat">Bonus Millz</span>
		</div>
	</div>
</div>
<div class="row" id="randomPoints">
	<div class="col-8 col-lg-8">
		<h4>Earn Free Millz Once an Hour</h4>
		<div></div>
		<ol>
			<li>Encourage your friends to signup using the above link.</li>
			<li>Receive 10% of all Millz that your friends earn.</li>
		</ol>
	</div>
	<div class="row col-4 col-lg-4">
		<span id="nextSpin">0</span>
		<div class="center">
			<a class="btn btn-success" href="/dashboard/hourlymillz" id="freeMillz">Claim Free Millz Now</a>
		</div>
	</div>
</div>
<div id="earnPoints">
	<?php for($i = 0; $i < count($earn); $i++){ ?>
	<div>
		<div class="points"><?php echo $earn[$i]['Reward']['points']; ?> Millz</div>
		<h3><?php echo $earn[$i]['Reward']['name']; ?></h3>
		<?php echo $earn[$i]['Reward']['description']; ?>
	</div>
	<?php } ?>
</div>
