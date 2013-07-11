$(function(){
	var choice = $("input[name=data\\[User\\]\\[payment\\]]:checked").val();
	if(choice == "paypal"){
		$(".paypal_large.choice").click();
	}else if(choice == "check"){
		$(".check_large.choice").click();
	}
});