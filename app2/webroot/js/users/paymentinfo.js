$(function(){
	var choice = $("input[name=data\\[User\\]\\[payment\\]]:checked").val();
	if(choice == "Paypal"){
		$("#paypalChoice, #UserPaymentinfoForm input[type='submit']").slideDown();
	}else if(choice == "Check"){
		$("#checkChoice, #UserPaymentinfoForm input[type='submit']").slideDown();
	}
});