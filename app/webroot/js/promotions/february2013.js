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