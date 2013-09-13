$(function(){
	$.ajax({
		url: '/apis/checkspintime',
		success: function(result){
			a = JSON.parse(result);
			if(a.time == true){
				$("#freeMillz").css('display', 'inline-block');
			}
			$("#nextSpin").countdown({
				until: new Date(a.time * 1000)
			});
		}
	});
});
