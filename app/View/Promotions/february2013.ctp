<script>
	function FacebookInviteFriends(){
		FB.ui({ method: 'apprequests', 
			message:'I\'ve invited you to check out BOX\'NGO - a free place to buy, sell, and trade online for students!'},
				function(receiverUserIds) {	
					$.ajax({
						url: '/promotions/february2013/step3',
						type: 'POST',
						data: ({friends: receiverUserIds.to}),
						success: function(success){
							success = $.parseJSON(success);
							console.log(success);
							if(success.success == true){
								location.reload();
							}else{
								alert("You must be logged in and invite at least 3 friends via Facebook.");
							}
						}
					});
				}
		);
	}
	
	$(document).ready(function(){
		$("#redeem").on("click", function(event){
			event.preventDefault();
			$(".promotion_wrapper > div, #EntryFebruary2013submitForm").stop(true,true).slideToggle();
			$(this).parent().remove();
		});
	});
</script>
<style>
	@import url(http://fonts.googleapis.com/css?family=Rokkitt);
	#content.wrapper{
		background: url('/images/promotions/february2013/bg.jpg') no-repeat;
		height: 1050px;
		padding: 20px;
		border-radius: 9px;
	}
	
	.promotion_wrapper{
		width: 700px;
		margin: auto;
	}
	#content.wrapper > div > div{
		display: block;
		min-height: 175px;
		background: rgba(255,255,255,.9);
		padding: 10px 20px 30px 20px;
		-moz-box-shadow: 0 0 15px #888;
		-webkit-box-shadow: 0 0 15px#888;
		box-shadow: 0 0 15px #888;
		margin-bottom: 10px;
	}
	#content.wrapper div.about{
		display: block;
		margin: 0;
		padding: 40px;
		color: #FFF;
		
		width: 700px;
		margin: auto;
		background: rgba(90,124,194,.8);
		-moz-box-shadow: 0 0 15px #888;
		-webkit-box-shadow: 0 0 15px#888;
		box-shadow: 0 0 15px #888;
		margin-bottom: 20px;
	}
	
	#content.wrapper .about h1{
		text-align: center;
		font-size: 34pt;
		color: #FFF;
	}
	
	#content.wrapper h1{
		font-family: 'Rokkitt', serif;
	}
	
	#content.wrapper > div > div h1{
		font-size: 26px;
		color: #585858;
		line-height: 1em;
		margin: 10px 0;
	}
	
	#content.wrapper img.check{
		float: left;
		padding: 20px 25px;
	}
	
	#EntryFebruary2013submitForm{
		display: none;
	}
	
	#EntryFebruary2013submitForm .row{
		min-width: 0;
		border-radius: 5px;
		overflow: hidden;
		background: rgba(0,0,0,.7);
	}
	#EntryFebruary2013submitForm div.input{
		background: rgba(0,0,0,.7);
		padding: 10px 20px;
		border-radius: 5px;
		margin-bottom: 10px;
	}
	
	#EntryFebruary2013submitForm .row div.input{
		border-radius: 0;
		background: transparent;
	}
	
	#EntryFebruary2013submitForm label{
		color: #FFF;
	}
	
	#redeem{
		float: none;
		width: 100%;
		display:  block;
		margin: 0;
		margin-top: 20px;
		padding: 15px;
	}
	
	.about .prize{
		float: left;
		height: 180px;
		margin-right: 20px;
	}
	
</style>
<?php debug($promotion); ?>
<div id="content" class="wrapper">
		<div class="clearfix about">
			<img class="prize" src="/images/promotions/february2013/prize1.png" /><h1>FREE Charm Give-a-way!</h1>
			We're giving out free Chinese scriptured charms that are sure to dazzle. No catch, no tricks. Simply follow the 3 easy steps and we'll ship you a charm in the mail!* 
			<p style="font-size:11px;">*Limited quantities available.</p>
		</div>
		<div class="promotion_wrapper">
			<div>
				<?php if($promotion['february2013.step1'] == true){ ?><img class="check" src="/images/checkmarkbox.png" /><?php } ?>
				<h1><a href="http://theboxngo.com/users" target="_blank">Step 1 - Register and activate your account on BOX'NGO!</a></h1>
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
			<form>
				<input id="redeem" type="submit" value="Click here to Redeem your Free Charm!" />
			</form>
		<?php if($promotion['february2013.step3'] == true){ ?>
			<?php echo $this->Form->create("Entry", array("action" => "february2013submit")); ?>
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
			<?php echo $this->Form->end("Redeem"); ?>
		<?php } ?>
		</div>
		
</div>
