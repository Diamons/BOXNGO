$(function(){
	$("#applyCoupon").on("click", function(event){
		event.preventDefault();
		var form = $("#PaymentForm");
		$(form).attr('action', $(form).data('coupon')).submit();
	});
});