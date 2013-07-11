<?php $this->start('scriptBottom');
echo $this->Html->script(array('promotions/february2013'));
$this->end();
$this->start('css');
echo $this->Html->css(array('promotions/february2013'));
$this->end();
?>
<div id="content" class="wrapper">
		<div class="clearfix about">
			<img class="prize" src="/images/promotions/february2013/prize1.png" /><h1>FREE Charm Give-a-way!</h1>
			We're giving out free Chinese scriptured charms that are sure to dazzle. No catch, no tricks. Simply follow the 3 easy steps and we'll ship you a charm in the mail!*
			<p>*Limited quantities available. Promotion expires February 28th, 2013 at 11:59 PM GMT -5.</p>
		</div>
		<div class="promotion_wrapper">
			<div>
				<?php if($promotion['february2013.step1'] == true){ ?><img class="check" src="/images/checkmarkbox.png" /><?php } ?>
				<h1><a href="http://theboxngo.com/users" target="_blank">Step 1 - Login to your account on BOX'NGO!</a></h1>
				If you haven't done so already, head over to the registration page to register on BOX'NGO! Go to your email inbox and click the activation link! Come back to this page once you've logged in using your BOX'NGO account.
			</div>
			<div>
				<div class="row">
					<div class="six columns">
						<?php if($promotion['february2013.step1'] == true){ ?><img class="check" src="/images/checkmarkbox.png" /><?php } ?>
						<h1><a href="http://www.facebook.com/theboxngo" target="_blank">Step 2 - Like our Facebook Page!</a></h1>
						Visit our Facebook page using your Facebook account and like the BOX'NGO page! We will not be able to deliver charms to people who haven't liked our page.
					</div>
					<div style="min-height:86px;" class="six columns">
						<div class="fb-like-box" data-href="http://www.facebook.com/theboxngo" data-width="292" data-border-color="#FFFFFF" data-show-faces="true" data-stream="false" data-header="false"></div>
					</div>
				</div>
			</div>
			<div>
				<?php if($promotion['february2013.step3'] == true){ ?><img class="check" src="/images/checkmarkbox.png" /><?php } ?>
				<h1><a href='#' onClick="FacebookInviteFriends();">Step 3 - Invite 3 Friends! (Click Here)</a></h1>
				 Invite 3 of your friends to check out BOX'NGO! Once you invite 3 friends, this page will refresh and you'll be able to redeem your charms!
			</div>
		<?php if($promotion['february2013.step3'] == true){ ?>	
			<form>
				<input id="redeem" type="submit" value="Click here to Redeem your Free Charm!" />
			</form>
		
			<?php echo $this->Form->create("Entry", array("id" => "EntryFebruary2013submitForm", "url" => "/promotions/february2013submit")); ?>
			<?php echo $this->Form->input("Entry.first_name"); ?>
			<?php echo $this->Form->input("Entry.last_name"); ?>
			<?php echo $this->Form->input("Entry.street_address"); ?>
			<div class="row">
				<div class="four columns">
					<?php echo $this->Form->input("Entry.city"); ?>
				</div>
				<div class="four columns">
					<?php echo $this->Form->input("Entry.state"); ?>
				</div>
				<div class="four columns">
					<?php echo $this->Form->input("Entry.zipcode"); ?>
				</div>
			</div>
			<?php echo $this->Form->input("Entry.selection", array("label" => "Choose a charm (Fong, Wong, Zhu, Ma, Luo, Ou, Li, Liang, or Dai) or leave empty to receive a random charm")); ?>
			<?php echo $this->Form->end("Redeem"); ?>
		<?php } ?>
		</div>
		
</div>
