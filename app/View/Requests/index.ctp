<style>
	#newRequest:before{
		content: '+ ';
	}

	#newRequest{
		background: orange;
		color: #FFF;
		font-weight: bolder;
		font-size: 16px;
		text-transform: lowercase;
		padding: 10px 30px;
		display: inline-block;
		transition: .3s;
		-webkit-transition: .3s;
		-moz-transition: .3s;
	}

	#newRequest:hover{
		background: #777;
	}

	#content.wrapper > .seven.columns{
		padding-right: 30px;
	}

	.request{
		background: #FAFAFA;
		-moz-box-shadow: 0 0 2px #DDD;
		-webkit-box-shadow: 0 0 2px#DDD;
		box-shadow: 0 0 2px #DDD;
		border-radius: 4px;

	}

	.request .post img.avatar{
		margin: auto;
		display: block;
		width: 100px;
	}

	.request .post div.name{
		text-align: center;
		margin-top: 6px;
		font-size: 12px;
	}

	.request .user_info{
		padding: 20px 0;
	}

	.request .request_message{
		padding: 20px 20px 20px 0;
		font-size: 12px;
	}

	.request .request_message > div{
		background: #FEFEFE;
		padding: 20px;
		color: #888;
		font-size: 14px;
		border: 1px solid #EEE;
	}

</style>
<div id="content" class="row wrapper">
	<div class="col-1 col-lg-1s"></div>
	<div class="col-7 col-lg-7">
		<div class="request">
			<div class="row post">
				<div class="user_info col-2 col-lg-2">
					<img class="avatar" src="/images/avataricon.gif" />
					<div class="name">Shahruk Khan</div>
				</div>
				<div class="request_message col-10 col-lg-10">
					<div>
						//nl2br and h Dear sir, I have a request!
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-3 col-lg-3">
		<a href="#" id="newRequest" data-reveal-id="requestForm">Submit New Request</a>
	</div>
	<div class="col-1 col-lg-1s"></div>
</div>
<div id="requestForm" class="reveal-modal medium">
	<h2>Request Form</h2>
	<p class="lead">It's like magic, but cooler.</p>
	<p>Want something at a price nobody else has? Retailers want to make a profit, but sometimes people just want to get rid of something and make whatever they can off of it. You can leave a request and when someone replies to you, you'll automatically be notified.</p>
	<a class="close-reveal-modal">&#215;</a>
</div>
