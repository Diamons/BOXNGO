$(document).ready(function () {
    
	$.ajax({
		url: '/dashboard/hourlymillz?ajax=true',
		success: function(result){
			result = JSON.parse(result);
			result = result.result.toString();
			
			endNumber = [];
			tmpLength = result.length;
			while(tmpLength < 3){
				endNumber.push("0");
				tmpLength++;
			}
			for(i = 0; i < result.length; i++){
				endNumber.push(parseInt(result.charAt(i),10));
			}

			$('.slot').jSlots({
				spinner: '#start',
				winnerNumber: 0,
				endNumbers: endNumber,
				loops: 5,
				time: 8000,
				onEnd: function(){
					$("#done").slideDown();
				}
			});
			$("#start").click();
		}
	});
    
	
});
