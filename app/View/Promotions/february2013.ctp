<script>
	function FacebookInviteFriends()
	{
	FB.ui({ method: 'apprequests', 
	   message:'I\'ve invited you to check out BOX\'NGO - a free place to buy, sell, and trade online for students!'},
         function(receiverUserIds) {
		}
         );
	}
</script>
<style>
	@import url(http://fonts.googleapis.com/css?family=Rokkitt);
	#content.wrapper{
		background: url('/images/promotions/february2013/bg.jpg') no-repeat;
		height: 891px;
		padding: 20px;
		border-radius: 9px;
	}
	
	#content.wrapper > div{
		display: block;
		width: 700px;
		margin: auto;
		min-height: 20px;
		background: rgba(255,255,255,.9);
		padding: 10px 20px 30px 20px;
		-moz-box-shadow: 0 0 15px #888;
		-webkit-box-shadow: 0 0 15px#888;
		box-shadow: 0 0 15px #888;
		margin-bottom: 10px;
	}
	#content.wrapper > div.about{
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
	
	#content.wrapper > div.about h1{
		text-align: center;
		font-size: 34pt;
		color: #FFF;
	}
	
	#content.wrapper h1{
		font-family: 'Rokkitt', serif;
	}
	
	#content.wrapper > div h1{
		font-size: 26px;
		color: #585858;
		line-height: 1em;
		margin: 10px 0;
	}
</style>
<div id="content" class="wrapper">
		<div class="about">
			<h1>FREE Charm Give-a-way!</h1>
			We're giving out free Chinese scriptured charms that are sure to dazzle. No catch, no tricks. Simply follow the 3 easy steps and we'll ship you a charm in the mail! All we ask is that you give BOX'NGO 
		</div>
		<div>
			<h1><a href="#">Step 1 - Register and activate your account on BOX'NGO!</a></h1>
			If you haven't done so already, head over to the registration page to register on BOX'NGO!
		</div>
		<div>
			<h1><a href="#">Step 2 - Like our Facebook Page!</a></h1>
			Visit our Facebook page using your Facebook account and like the BOX'NGO page!
		</div>
		<div>
			<h1><a href='#' onClick="FacebookInviteFriends();">Step 3 - Invite 3 Friends!</a></h1>
			 Invite 3 of your friends to check out BOX'NGO!
		</div>
</div>
