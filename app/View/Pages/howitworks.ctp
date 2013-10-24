<?php 
$this->start('css');
echo $this->Html->css('users/index');
$this->end();
?>
<script>
	$(function(){
		$("#about_boxngo div.columns").on("click", function(event){
			event.preventDefault();
			var link = $(this).find("a");
			$(".moreinfo").stop(true,true).slideUp();
			$(link.attr('href')).stop(true,true).slideDown();
			$("#about_boxngo span.enlarge").removeClass('active');
			$(this).find('span.enlarge').addClass('active');
		});
		
		$(".moreinfo .close").on("click", function(event){
			var tempId = $(this).parent().attr('id');
			$("#"+tempId).stop(true,true).slideUp();
			$("#about_boxngo span.enlarge").removeClass('active');
		});

		$("#about_boxngo div.four.columns:first-child").click();
	});
</script>
<div id="content" class="wrapper">
	<div id="about_boxngo" class="wrapper modified_padding">
		<div class="row">
			<div class="col-xs-6 col-md-6">
				<span class="icon-credit-card enlarge"></span>
				<h1>Buy</h1>
				<div class="detail">Find local sellers just like you selling handmade crafts, electronics, clothing, and much more. BOX'NGO is the easiest way to buy from other people using our online marketplace.<br />
				<a href="#buyinfo">How does it work?</a></div>
			</div>
			<div class="col-xs-6 col-md-6">
				<span class="icon-tag enlarge"></span>
				<h1>Sell</h1>
				<div class="detail">There's no easier way to sell online than BOX'NGO. List your stuff, ship the package, and make money. Yes, it's just that easy. We take care of everything else, you just sell.
				<a href="#sellinfo">How does it work?</a></div>
			</div>
		</div>
	</div>

	<div id="buyinfo" class="wrapper modified_padding moreinfo">
		<a href="#" class="close">Close</a>
		<div class="row">
			<div class="col-xs-4 col-md-4">
				<span class="typicn directions enlarge"></span>
				<h4>Browse</h4>
				<div class="detail">
					Search through our listings for textbooks, handmade jewelry, electronics, and so much more!
				</div>
			</div>
			<div class="col-xs-4 col-md-4">
				<span class="enlarge">$</span>
				<h4>Buy / Trade</h4>
				<div class="detail">
					Once you find something you like, simply pay for it online or choose to either pay in cash, or make a trade offer.
				</div>
			</div>
			<div class="col-xs-4 col-md-4">
				<span class="enlarge typicn tick"></span>
				<h4>Receive Your Item</h4>
				<div class="detail">
					If you chose to buy your item, all you need to do is wait for the item to come in the mail or if you chose to trade or pay with cash, simply meet with the person and conduct the transaction!
				</div>
			</div>
		</div>
	</div>

	<div id="sellinfo" class="wrapper modified_padding moreinfo">
		<a href="#" class="close">Close</a>
		<div class="row">
			<div class="col-xs-4 col-md-4">
				<span class="typicn list enlarge"></span>
				<h4>List</h4>
				<div class="detail">
					Quickly list your item within minutes by using our simple <a style="color: #0072ac;" href="/shops/shoplist">List an Item</a> form. For online credit card and debit card transactions, we charge a 10% fee.
				</div>
			</div>
			<div class="col-xs-4 col-md-4">
				<span class="typicn forward enlarge"></span>
				<h4>Ship</h4>
				<div class="detail">
					Once you receive a notification someone has bought your item, package your stuff into a box and purchase a tracking number. Simply input the tracking number into BOX'NGO and you're set!
				</div>
			</div>
			<div class="col-xs-4 col-md-4">
				<span class="enlarge typicn thumbsUp"></span>
				<h4>Get Paid</h4>
				<div class="detail">
					24 hours after the package is delivered, you'll have the funds directly transferred to your Paypal account or receive a check in the mail shortly afterwards. Yeah, it's that simple.
				</div>
			</div>
		</div>
	</div>

	<div id="tradeinfo" class="wrapper modified_padding moreinfo">
		<a href="#" class="close">Close</a>
		<div class="row">
			<div class="col-xs-4 col-md-4">
				<span class="typicn unknown enlarge"></span>
				<h4>Make an Offer</h4>
				<div class="detail">
					Send a message to the seller asking if they would be willing to make a trade for what you have to offer. Currently trades and offers are restricted to students attending the same university.
				</div>
			</div>
			<div class="col-xs-4 col-md-4">
				<span class="typicn chat enlarge"></span>
				<h4>Arrange to Meet</h4>
				<div class="detail">
					Set up a time and place to meet that is convenient for both of you! We generally recommend this be a familar environment such as your college or school.
				</div>
			</div>
			<div class="col-xs-4 col-md-4">
				<span class="enlarge sync typicn"></span>
				<h4>Make the Trade</h4>
				<div class="detail">
					Verify the details and make the trade! It's as simple as that!
				</div>
			</div>
		</div>
	</div>
</div>
