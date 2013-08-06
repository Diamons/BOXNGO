$(function(){
	$(".starRatings").jRating({
		length: 10,
		decimalLength: 1,
		bigStarsPath: '/css/icons/stars.png',
		rateMax: 10,
		canRateAgain: true,
		nbRates: 10,
		step: true,
		onSuccess: function(elem,value){
			$("#ReviewRating"+value).click();
		}
	});
});
